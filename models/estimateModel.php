<?php

class Estimate
{
    private int $id;
    private string $nameEstimate;
    private string $customer;
    private $date;
    private string $ressources;

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
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of ressources
     */
    public function getRessources()
    {
        return $this->ressources;
    }

    /**
     * Set the value of ressources
     *
     * @return  self
     */
    public function setRessources($ressources)
    {
        $this->ressources = $ressources;

        return $this;
    }

    /**
     * Get the value of nameEstimate
     */
    public function getNameEstimate()
    {
        return $this->nameEstimate;
    }

    /**
     * Set the value of nameEstimate
     *
     * @return  self
     */
    public function setNameEstimate($nameEstimate)
    {
        $this->nameEstimate = $nameEstimate;

        return $this;
    }

    /**
     * Get the value of customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set the value of customer
     *
     * @return  self
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }
}
