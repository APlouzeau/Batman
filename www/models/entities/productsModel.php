<?php

class Products
{
    private int $id;
    private string $name;
    private string $type;
    private string $length;
    private string $recovery;
    private string $summary;
    private string $descriptionProduct;
    private float $price;

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

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    /**
     * Get the value of length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of recovery
     */
    public function getRecovery()
    {
        return $this->recovery;
    }

    /**
     * Set the value of recovery
     *
     * @return  self
     */
    public function setRecovery($recovery)
    {
        $this->recovery = $recovery;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescriptionProduct()
    {
        return $this->descriptionProduct;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescriptionProduct($description)
    {
        $this->descriptionProduct = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = floatval($price);

        return $this;
    }

    /**
     * Get the value of summary
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set the value of summary
     *
     * @return  self
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get the value of summary
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of summary
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
