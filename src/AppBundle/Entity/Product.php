<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 26.07.2018
 * Time: 21:17
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Product
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Product
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *@ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Заполните поле")
     */
    protected $category;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(message="Заполните поле")
     */
    protected $weight;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(message="Заполните поле")
     */
    protected $price;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function __toString()
    {
        return $this->getCategory();
    }
}