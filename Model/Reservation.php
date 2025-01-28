<?php
    class Reservation {
        public $id, $accommodationId, $arrival, $departure, $guestName, $guestEmail, $guestCountry, $numberOfPeople, $locationPlace, $locationRiviera, $locationRegion, $locationType, $payments;

        function __construct($data) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }

        public static function getAllReservations() {
            $data = file_get_contents('https://api.adriatic.hr/test/reservations');
            $reservationsData = json_decode($data, true);
    
            $reservations = [];
            foreach ($reservationsData as $reservationData) {
                $reservations[] = new Reservation($reservationData);
            }
    
            return $reservations;
        }
    }