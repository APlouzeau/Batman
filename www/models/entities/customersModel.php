<?php

class Customers
{
    private int $id;
    private string $nameCustomer;
    private string $adress;
    private string $mailGeneric;
    private string $siren;
    private string $nameContact;
    private string $mailContact;
    private string $adressContact;


    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
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
     * Get the value of name
     */
    public function getNameCustomer()
    {
        return $this->nameCustomer;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setNameCustomer($nameCustomer)
    {
        $this->nameCustomer = $nameCustomer;

        return $this;
    }

    /**
     * Get the value of adress
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set the value of adress
     *
     * @return  self
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get the value of mailGeneric
     */
    public function getMailGeneric()
    {
        return $this->mailGeneric;
    }

    /**
     * Set the value of mailGeneric
     *
     * @return  self
     */
    public function setMailGeneric($mailGeneric)
    {
        $this->mailGeneric = $mailGeneric;

        return $this;
    }
    /*
    * @return  self
    */
    public function setSiren($siren)
    {
        $this->siren = intval($siren);

        return $this;
    }
    /**
     * Get the value of siren
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * Set the value of siren
     *

    /**
     * Get the value of nameContact
     */
    public function getNameContact()
    {
        return $this->nameContact;
    }

    /**
     * Set the value of nameContact
     *
     * @return  self
     */
    public function setNameContact($nameContact)
    {
        $this->nameContact = $nameContact;

        return $this;
    }

    /**
     * Get the value of mailContact
     */
    public function getMailContact()
    {
        return $this->mailContact;
    }

    /**
     * Set the value of mailContact
     *
     * @return  self
     */
    public function setMailContact($mailContact)
    {
        $this->mailContact = $mailContact;

        return $this;
    }

    /**
     * Get the value of adressContact
     */
    public function getAdressContact()
    {
        return $this->adressContact;
    }

    /**
     * Set the value of adressContact
     *
     * @return  self
     */
    public function setAdressContact($adressContact)
    {
        $this->adressContact = $adressContact;

        return $this;
    }
}
