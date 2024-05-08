<?php

class Estimate
{
    private int $id;
    private string $nameEstimate;
    private string $idCustomer;
    private $date;
    private int $idTasks;

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
     * Get the value of idTasks
     */
    public function getIdTasks()
    {
        return $this->idTasks;
    }

    /**
     * Set the value of idTasks
     *
     * @return  self
     */
    public function setIdTasks($idTasks)
    {
        $this->idTasks = $idTasks;

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
     * Get the value of idCustomer
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * Set the value of idCustomer
     *
     * @return  self
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;

        return $this;
    }
}
