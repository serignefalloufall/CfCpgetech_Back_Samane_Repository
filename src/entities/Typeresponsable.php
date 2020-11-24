<?php

// namespace src\entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="typeresponsable")
 */

class Typeresponsable
{
        /** 
         * @Id
         * @Column(type="integer")
         * @GeneratedValue
         */
        private $id;
        /** 
         * @Column(type="string") 
         */
        private $libelle;

        /**
         * One typeresponsable has many responsables. This is the inverse side.
         * @OneToMany(targetEntity="Responsable", mappedBy="type_responsable_id")
         */
        private $responsables;


        //Definition des constructeur
        public function __construct()
        {
            $this->responsables = new ArrayCollection();
        }

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of libelle
         */
        public function getLibelle()
        {
                return $this->libelle;
        }

        /**
         * Set the value of libelle
         *
         * @return  self
         */
        public function setLibelle($libelle)
        {
                $this->libelle = $libelle;

                return $this;
        }
}
