<?php

namespace App\Models;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */
class Items
{
    /**
     * @ApiProperty(identifier=true)
     * @var string $name
     */
    private $name;

    /**
     * @var int
     */
    private $averageItemLevel;

    /**
     * @var int
     */
    private $averageItemLevelEquipped;

    /**
     * @var array
     */
    private $head;

    /**
     * @var array
     */
    private $neck;

    /**
     * @var array
     */
    private $shoulder;

    /**
     * @var array
     */
    private $back;

    /**
     * @var array
     */
    private $chest;

    /**
     * @var array
     */
    private $tabard;

    /**
     * @var array
     */
    private $wrist;

    /**
     * @var array
     */
    private $hands;

    /**
     * @var array
     */
    private $waist;

    /**
     * @var array
     */
    private $legs;

    /**
     * @var array
     */
    private $feet;

    /**
     * @var array
     */
    private $finger1;

    /**
     * @var array
     */
    private $finger2;

    /**
     * @var array
     */
    private $trinket1;

    /**
     * @var array
     */
    private $trinket2;

    /**
     * @var array
     */
    private $mainHand;

    /**
     * @var array
     */
    private $offHand;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Items
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAverageItemLevel(): ?int
    {
        return $this->averageItemLevel;
    }

    /**
     * @param int $averageItemLevel
     * @return Items
     */
    public function setAverageItemLevel(int $averageItemLevel): self
    {
        $this->averageItemLevel = $averageItemLevel;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAverageItemLevelEquipped(): ?int
    {
        return $this->averageItemLevelEquipped;
    }

    /**
     * @param int $averageItemLevelEquipped
     * @return Items
     */
    public function setAverageItemLevelEquipped(int $averageItemLevelEquipped): self
    {
        $this->averageItemLevelEquipped = $averageItemLevelEquipped;

        return $this;
    }

    /**
     * @return array
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @param $head
     * @return Items
     */
    public function setHead($head): self
    {
        $this->head = $head;

        return $this;
    }

    /**
     * @return array
     */
    public function getNeck()
    {
        return $this->neck;
    }

    /**
     * @param $neck
     * @return Items
     */
    public function setNeck($neck): self
    {
        $this->neck = $neck;

        return $this;
    }

    /**
     * @return array
     */
    public function getShoulder()
    {
        return $this->shoulder;
    }

    /**
     * @param $shoulder
     * @return Items
     */
    public function setShoulder($shoulder): self
    {
        $this->shoulder = $shoulder;

        return $this;
    }

    /**
     * @return array
     */
    public function getBack()
    {
        return $this->back;
    }

    /**
     * @param $back
     * @return Items
     */
    public function setBack($back): self
    {
        $this->back = $back;

        return $this;
    }

    /**
     * @return array
     */
    public function getChest()
    {
        return $this->chest;
    }

    /**
     * @param $chest
     * @return Items
     */
    public function setChest($chest): self
    {
        $this->chest = $chest;

        return $this;
    }

    /**
     * @return array
     */
    public function getTabard()
    {
        return $this->tabard;
    }

    /**
     * @param $tabard
     * @return Items
     */
    public function setTabard($tabard): self
    {
        $this->tabard = $tabard;

        return $this;
    }

    /**
     * @return array
     */
    public function getWrist()
    {
        return $this->wrist;
    }

    /**
     * @param $wrist
     * @return Items
     */
    public function setWrist($wrist): self
    {
        $this->wrist = $wrist;

        return $this;
    }

    /**
     * @return array
     */
    public function getHands()
    {
        return $this->hands;
    }

    /**
     * @param $hands
     * @return Items
     */
    public function setHands($hands): self
    {
        $this->hands = $hands;

        return $this;
    }

    /**
     * @return array
     */
    public function getWaist()
    {
        return $this->waist;
    }

    /**
     * @param $waist
     * @return Items
     */
    public function setWaist($waist): self
    {
        $this->waist = $waist;

        return $this;
    }

    /**
     * @return array
     */
    public function getLegs()
    {
        return $this->legs;
    }

    /**
     * @param $legs
     * @return Items
     */
    public function setLegs($legs): self
    {
        $this->legs = $legs;

        return $this;
    }

    /**
     * @return array
     */
    public function getFeet()
    {
        return $this->feet;
    }

    /**
     * @param $feet
     * @return Items
     */
    public function setFeet($feet): self
    {
        $this->feet = $feet;

        return $this;
    }

    /**
     * @return array
     */
    public function getFinger1()
    {
        return $this->finger1;
    }

    /**
     * @param $finger1
     * @return Items
     */
    public function setFinger1($finger1): self
    {
        $this->finger1 = $finger1;

        return $this;
    }

    /**
     * @return array
     */
    public function getFinger2()
    {
        return $this->finger2;
    }

    /**
     * @param $finger2
     * @return Items
     */
    public function setFinger2($finger2): self
    {
        $this->finger2 = $finger2;

        return $this;
    }

    /**
     * @return array
     */
    public function getTrinket1()
    {
        return $this->trinket1;
    }

    /**
     * @param $trinket1
     * @return Items
     */
    public function setTrinket1($trinket1): self
    {
        $this->trinket1 = $trinket1;

        return $this;
    }

    /**
     * @return array
     */
    public function getTrinket2()
    {
        return $this->trinket2;
    }

    /**
     * @param $trinket2
     * @return Items
     */
    public function setTrinket2($trinket2): self
    {
        $this->trinket2 = $trinket2;

        return $this;
    }

    /**
     * @return array
     */
    public function getMainHand()
    {
        return $this->mainHand;
    }

    /**
     * @param $mainHand
     * @return Items
     */
    public function setMainHand($mainHand): self
    {
        $this->mainHand = $mainHand;

        return $this;
    }

    /**
     * @return array
     */
    public function getOffHand()
    {
        return $this->offHand;
    }

    /**
     * @param $offHand
     * @return Items
     */
    public function setOffHand($offHand): self
    {
        $this->offHand = $offHand;

        return $this;
    }
}
