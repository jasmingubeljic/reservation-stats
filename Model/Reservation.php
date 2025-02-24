<?php
    class Reservation {
        private $id, $accommodationId, $arrival, $departure, $guestName, $guestEmail, $guestCountry, $numberOfPeople, $locationPlace, $locationRiviera, $locationRegion, $locationType, $payments;

        function __construct($data) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }


        private static function getAllReservations() {
            $data = file_get_contents('https://api.adriatic.hr/test/reservations');
            $reservationsData = json_decode($data, true);
    
            $reservations = [];
            foreach ($reservationsData as $reservationData) {
                $reservations[] = new Reservation($reservationData);
            }
    
            return $reservations;
        }


        /* Reservation stats */
        public static function getReservationStats() {
            $reservations = self::getAllReservations();
            $stats = "reservation statistics placeholder";
            $stats = [
                "durationBasedStats" => self::computeDurationBasedStats($reservations),
                "yearlyIncomeInEur" => self::computeYearlyIncome($reservations),
                "returningGuests" => self::computeReturningGuestsList($reservations),
            ];
            return $stats;
        }


        /* Avg duration of reservations */
        private static function computeDurationBasedStats($reservations) {
            $days = 0;
            $top_places = [];
            $top_rivieras = [];
            foreach ($reservations as $reservation) {
                $arrival_date = new DateTime($reservation->arrival);
                $departure_date = new DateTime($reservation->departure);
                $duration = $arrival_date->diff($departure_date)->days;
                $days += $duration;
        
                /* t op 5 places */
                $place = $reservation->locationPlace;
                if (empty($top_places[$place])) {
                    $top_places[$place] = [];
                }
                $top_places[$place][] = $duration;
        
                /* top 5 rivieras*/
                $riviera = $reservation->locationRiviera;
                if (empty($top_rivieras[$riviera])) {
                    $top_rivieras[$riviera] = [];
                }
                $top_rivieras[$riviera][] = $duration;
            }
        
            $average_duration_for_all_reservations = $days/count($reservations);
        
            $place_avg = [];
            foreach ($top_places as $place => $durations) {
                $place_avg[$place] = round(array_sum($durations) / count($durations), 2);
            }
            $riviera_avg = [];
            foreach ($top_rivieras as $riviera => $durations) {
                $riviera_avg[$riviera] = round(array_sum($durations) / count($durations), 2);
            }
            arsort($place_avg);
            arsort($riviera_avg);
            $top_5_places = array_slice($place_avg, 0, 5);
            $top_5_rivieras = array_slice($riviera_avg, 0, 5);
            $average_duration_for_all_reservations = round($average_duration_for_all_reservations,2);
        
            return [
                'average_duration' => $average_duration_for_all_reservations,
                'top_5_places' => $top_5_places,
                'top_5_rivieras' => $top_5_rivieras
            ];
        }


        private static function computeYearlyIncome($reservations) {
            $yearly_income =[];
            foreach($reservations as $reservation) {
                $year_of_guest_arrival = (new DateTime($reservation->arrival)) -> format("Y");
                $total_payment_amount = $reservation->payments['advance']['amount'] + $reservation->payments['remainder']['amount'];
        
                if (!isset($yearly_income[$year_of_guest_arrival])) {
                    $yearly_income[$year_of_guest_arrival] = 0;
                }
                $yearly_income[$year_of_guest_arrival] += $total_payment_amount;
            }
        
            return $yearly_income;
        }


        private static function computeReturningGuestsList($reservations) {
            $guest_count = [];
            foreach ($reservations as $reservation) {
                $guestName = $reservation->guestName;
                if (!isset($guest_count[$guestName]) ) {
                        $guest_count[$guestName] = 0;
                }
                $guest_count[$guestName] = $guest_count[$guestName]+1;
            }
            $returning_guests = array_filter($guest_count, function($count) {
                return $count>1;
            });
            arsort($returning_guests);

            return $returning_guests;
        }
    }