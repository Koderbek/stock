<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 26.07.2018
 * Time: 21:19
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class WorkingShift
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class WorkingShift
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     * @ORM\Column(type="date")
     *
     * @Assert\NotBlank(message="Заполните поле")
     * @Assert\Date(message="Ошибка формата")
     */
    protected $date;

    /**
     * @var ArrayCollection|Porter[]
     * @ORM\ManyToOne(targetEntity="Porter")
     */
    protected $porter;

    /**
     * @var ArrayCollection|Product[]
     * @ORM\ManyToOne(targetEntity="Product")
     */
    protected $product;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(message="Заполните поле")
     */
    protected $count;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(message="Заполните поле")
     */
    protected $weight;

    public function __construct()
    {
        $this->porter = new ArrayCollection();
        $this->product = new ArrayCollection();
        $this->weight = 0;
    }

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
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return Porter[]|ArrayCollection
     */
    public function getPorter()
    {
        return $this->porter;
    }

    /**
     * @param Porter[]|ArrayCollection $porter
     */
    public function setPorter($porter)
    {
        $this->porter = $porter;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product[]|ArrayCollection $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
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
}