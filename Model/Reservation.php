<?php
    class Reservation {
        private $id, $accommodationId, $arrival, $departure, $guestName, $guestEmail, $guestCountry, $numberOfPeople, $locationPlace, $locationRiviera, $locationRegion, $locationType, $payments;

        public function __construct($data) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }