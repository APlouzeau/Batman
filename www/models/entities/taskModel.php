<?php

class Task
{
    private $id;
    private $idEstimate;
    private $taskNumber;
    private $descriptionTask;
    private $quantity;
    private $unitPrice;


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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getDescriptionTask()
    {
        return $this->descriptionTask;
    }

    public function setDescriptionTask($descriptionTask)
    {
        $this->descriptionTask = $descriptionTask;
        return $this;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    /**
     * Get the value of taskNumber
     */
    public function getTaskNumber()
    {
        return $this->taskNumber;
    }

    /**
     * Set the value of taskNumber
     *
     * @return  self
     */
    public function setTaskNumber($taskNumber)
    {
        $this->taskNumber = $taskNumber;

        return $this;
    }


    public function getIdEstimate()
    {
        return $this->idEstimate;
    }

    public function setIdEstimate($value)
    {
        $this->idEstimate = $value;
    }
}
