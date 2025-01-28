<?php
    class Reservation {
        // shodno opisu taska, samo ce 'getReservationStats' biti public
        private $id, $accommodationId, $arrival, $departure, $guestName, $guestEmail, $guestCountry, $numberOfPeople, $locationPlace, $locationRiviera, $locationRegion, $locationType, $payments;

        function __construct($data) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }

        /* servis za dohvacanje rezervacija, i kreiranje liste objekata na osnovu Reservation class */
        private static function getAllReservations() {
            $data = file_get_contents('https://api.adriatic.hr/test/reservations');
            $reservationsData = json_decode($data, true);
    
            $reservations = [];
            foreach ($reservationsData as $reservationData) {
                $reservations[] = new Reservation($reservationData);
            }
    
            return $reservations;
        }

        /* statistika rezervacija */
        public static function getReservationStats() {
            $reservations = self::getAllReservations();
            $stats = "reservation statistics placeholder";
            $stats = [
                "yearlyIncomeInEur" => self::computeYearlyIncome($reservations),
                "returningGuests" => self::computeReturningGuestsList($reservations),
            ];
            return $stats;
        }


         /* Ukupan prihod od rezervacija po godini. */ 
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


        /* Lista gostiju koji su rezervirali više od jednom (poredanih od najvećeg broja ostvarenih rezervacija prema najmanjem) */
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