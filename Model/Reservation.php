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

        /* servis za dohvacanje rezervacija, i kreiranje liste objekata na osnovu Reservation class */
        public static function getAllReservations() {
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
                "returningGuests" => self::computeReturningGuestsList($reservations),
            ];
            return $stats;
        }


        /* Lista gostiju koji su rezervirali više od jednom (poredanih od najvećeg broja ostvarenih rezervacija prema najmanjem) */
        private static function computeReturningGuestList($reservations) {
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