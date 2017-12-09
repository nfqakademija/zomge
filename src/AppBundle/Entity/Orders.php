<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdersRepository")
 */
class Orders implements \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="order_number", type="string", length=255)
     */
    private $orderNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     * @Assert\NotBlank(groups={"buy"})
     * @Assert\Image(groups={"buy"})
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", options={"default":"1"})
     * @Assert\NotNull(groups={"set_status"})
     */
    private $status;

    /**
     * @ORM\Column(name="back_panel", type="string")
     */
    private $backPanel;

    /**
     * @ORM\Column(name="back_panel_price", type="decimal", precision=8, scale=0)
     */
    private $backPanelPrice;

    /**
     * @ORM\Column(name="is_paid", type="boolean", options={"default": false})
     */
    private $isPaid;

    /**
     * @ORM\Column(name="total_price", type="decimal", precision=8, scale=0)
     */
    private $totalPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @see \Serializable::serialize()
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->photo
        ));
    }

    /**
     * @see \Serializable::unserialize()
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id
            ) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param User $user
     * @return Orders
     * @internal param int $user
     *
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set orderNumber
     *
     * @param string $orderNumber
     *
     * @return Orders
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Orders
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Orders
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get readable status
     *
     * @return string
     */
    public function getReadableStatus()
    {
        if ($this->status == 1) {
            return 'Accepted';
        } elseif ($this->status == 2) {
            return 'Shipped';
        } else {
            return 'Fulfilled';
        }
    }

    /**
     * @param $createdAt
     * @return mixed
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $createdAt;
    }

    /**
     * Get created at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getBackPanel()
    {
        return $this->backPanel;
    }

    /**
     * @param mixed $backPanel
     */
    public function setBackPanel($backPanel)
    {
        $this->backPanel = $backPanel;
    }

    /**
     * @return mixed
     */
    public function getBackPanelPrice()
    {
        return $this->backPanelPrice;
    }

    /**
     * @param mixed $backPanel
     * @return float
     */
    public function setBackPanelPrice($backPanel)
    {
        if ($backPanel == 'metal') {
            $this->backPanelPrice = '50.00';
        } elseif ($backPanel == 'glass') {
            $this->backPanelPrice = '100.00';
        } else {
            $this->backPanelPrice = 0;
        }

        return $this->backPanelPrice;
    }

    /**
     * @return mixed
     */
    public function getIsPaid()
    {
        return $this->isPaid;
    }

    /**
     * @param mixed $isPaid
     */
    public function setIsPaid($isPaid)
    {
        $this->isPaid = $isPaid;
    }

    /**
     * @return string
     */
    public function getReadableIsPaid()
    {
        if ($this->isPaid) {
            return 'Paid';
        }

        return 'Waiting for payment';
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }
}
