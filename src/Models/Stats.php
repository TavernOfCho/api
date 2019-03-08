<?php

namespace App\Models;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */
class Stats
{
    /**
     * @ApiProperty(identifier=true)
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $health;

    /**
     * @var string
     */
    private $powerType;

    /**
     * @var string
     */
    private $power;

    /**
     * @var string
     */
    private $str;

    /**
     * @var string
     */
    private $agi;

    /**
     * @var string
     */
    private $int;

    /**
     * @var string
     */
    private $sta;

    /**
     * @var string
     */
    private $speedRating;

    /**
     * @var string
     */
    private $speedRatingBonus;

    /**
     * @var string
     */
    private $crit;

    /**
     * @var string
     */
    private $critRating;

    /**
     * @var string
     */
    private $haste;

    /**
     * @var string
     */
    private $hasteRating;

    /**
     * @var string
     */
    private $hasteRatingPercent;

    /**
     * @var string
     */
    private $mastery;

    /**
     * @var string
     */
    private $masteryRating;

    /**
     * @var string
     */
    private $leech;

    /**
     * @var string
     */
    private $leechRating;

    /**
     * @var string
     */
    private $leechRatingBonus;

    /**
     * @var string
     */
    private $versatility;

    /**
     * @var string
     */
    private $versatilityDamageDoneBonus;

    /**
     * @var string
     */
    private $versatilityHealingDoneBonus;

    /**
     * @var string
     */
    private $versatilityDamageTakenBonus;

    /**
     * @var string
     */
    private $avoidanceRating;

    /**
     * @var string
     */
    private $avoidanceRatingBonus;

    /**
     * @var string
     */
    private $spellPen;

    /**
     * @var string
     */
    private $spellCrit;

    /**
     * @var string
     */
    private $spellCritRating;

    /**
     * @var string
     */
    private $mana5;

    /**
     * @var string
     */
    private $mana5Combat;

    /**
     * @var string
     */
    private $armor;

    /**
     * @var string
     */
    private $dodge;

    /**
     * @var string
     */
    private $dodgeRating;

    /**
     * @var string
     */
    private $parry;

    /**
     * @var string
     */
    private $parryRating;

    /**
     * @var string
     */
    private $block;

    /**
     * @var string
     */
    private $blockRating;

    /**
     * @var string
     */
    private $mainHandDmgMin;

    /**
     * @var string
     */
    private $mainHandDmgMax;

    /**
     * @var string
     */
    private $mainHandSpeed;

    /**
     * @var string
     */
    private $mainHandDps;

    /**
     * @var string
     */
    private $offHandDmgMin;

    /**
     * @var string
     */
    private $offHandDmgMax;

    /**
     * @var string
     */
    private $offHandSpeed;

    /**
     * @var string
     */
    private $offHandDps;

    /**
     * @var string
     */
    private $rangedDmgMin;

    /**
     * @var string
     */
    private $rangedDmgMax;

    /**
     * @var string
     */
    private $rangedSpeed;

    /**
     * @var string
     */
    private $rangedDps;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Stats
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getHealth(): ?string
    {
        return $this->health;
    }

    /**
     * @param string $health
     * @return Stats
     */
    public function setHealth(?string $health): self
    {
        $this->health = $health;

        return $this;
    }

    /**
     * @return string
     */
    public function getPowerType(): ?string
    {
        return $this->powerType;
    }

    /**
     * @param string $powerType
     * @return Stats
     */
    public function setPowerType(?string $powerType): self
    {
        $this->powerType = $powerType;

        return $this;
    }

    /**
     * @return string
     */
    public function getPower(): ?string
    {
        return $this->power;
    }

    /**
     * @param string $power
     * @return Stats
     */
    public function setPower(?string $power): self
    {
        $this->power = $power;

        return $this;
    }

    /**
     * @return string
     */
    public function getStr(): ?string
    {
        return $this->str;
    }

    /**
     * @param string $str
     * @return Stats
     */
    public function setStr(?string $str): self
    {
        $this->str = $str;

        return $this;
    }

    /**
     * @return string
     */
    public function getAgi(): ?string
    {
        return $this->agi;
    }

    /**
     * @param string $agi
     * @return Stats
     */
    public function setAgi(?string $agi): self
    {
        $this->agi = $agi;

        return $this;
    }

    /**
     * @return string
     */
    public function getInt(): ?string
    {
        return $this->int;
    }

    /**
     * @param string $int
     * @return Stats
     */
    public function setInt(?string $int): self
    {
        $this->int = $int;

        return $this;
    }

    /**
     * @return string
     */
    public function getSta(): ?string
    {
        return $this->sta;
    }

    /**
     * @param string $sta
     * @return Stats
     */
    public function setSta(?string $sta): self
    {
        $this->sta = $sta;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpeedRating(): ?string
    {
        return $this->speedRating;
    }

    /**
     * @param string $speedRating
     * @return Stats
     */
    public function setSpeedRating(?string $speedRating): self
    {
        $this->speedRating = $speedRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpeedRatingBonus(): ?string
    {
        return $this->speedRatingBonus;
    }

    /**
     * @param string $speedRatingBonus
     * @return Stats
     */
    public function setSpeedRatingBonus(?string $speedRatingBonus): self
    {
        $this->speedRatingBonus = $speedRatingBonus;

        return $this;
    }

    /**
     * @return string
     */
    public function getCrit(): ?string
    {
        return $this->crit;
    }

    /**
     * @param string $crit
     * @return Stats
     */
    public function setCrit(?string $crit): self
    {
        $this->crit = $crit;

        return $this;
    }

    /**
     * @return string
     */
    public function getCritRating(): ?string
    {
        return $this->critRating;
    }

    /**
     * @param string $critRating
     * @return Stats
     */
    public function setCritRating(?string $critRating): self
    {
        $this->critRating = $critRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getHaste(): ?string
    {
        return $this->haste;
    }

    /**
     * @param string $haste
     * @return Stats
     */
    public function setHaste(?string $haste): self
    {
        $this->haste = $haste;

        return $this;
    }

    /**
     * @return string
     */
    public function getHasteRating(): ?string
    {
        return $this->hasteRating;
    }

    /**
     * @param string $hasteRating
     * @return Stats
     */
    public function setHasteRating(?string $hasteRating): self
    {
        $this->hasteRating = $hasteRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getHasteRatingPercent(): ?string
    {
        return $this->hasteRatingPercent;
    }

    /**
     * @param string $hasteRatingPercent
     * @return Stats
     */
    public function setHasteRatingPercent(?string $hasteRatingPercent): self
    {
        $this->hasteRatingPercent = $hasteRatingPercent;

        return $this;
    }

    /**
     * @return string
     */
    public function getMastery(): ?string
    {
        return $this->mastery;
    }

    /**
     * @param string $mastery
     * @return Stats
     */
    public function setMastery(?string $mastery): self
    {
        $this->mastery = $mastery;

        return $this;
    }

    /**
     * @return string
     */
    public function getMasteryRating(): ?string
    {
        return $this->masteryRating;
    }

    /**
     * @param string $masteryRating
     * @return Stats
     */
    public function setMasteryRating(?string $masteryRating): self
    {
        $this->masteryRating = $masteryRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getLeech(): ?string
    {
        return $this->leech;
    }

    /**
     * @param string $leech
     * @return Stats
     */
    public function setLeech(?string $leech): self
    {
        $this->leech = $leech;

        return $this;
    }

    /**
     * @return string
     */
    public function getLeechRating(): ?string
    {
        return $this->leechRating;
    }

    /**
     * @param string $leechRating
     * @return Stats
     */
    public function setLeechRating(?string $leechRating): self
    {
        $this->leechRating = $leechRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getLeechRatingBonus(): ?string
    {
        return $this->leechRatingBonus;
    }

    /**
     * @param string $leechRatingBonus
     * @return Stats
     */
    public function setLeechRatingBonus(?string $leechRatingBonus): self
    {
        $this->leechRatingBonus = $leechRatingBonus;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersatility(): ?string
    {
        return $this->versatility;
    }

    /**
     * @param string $versatility
     * @return Stats
     */
    public function setVersatility(?string $versatility): self
    {
        $this->versatility = $versatility;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersatilityDamageDoneBonus(): ?string
    {
        return $this->versatilityDamageDoneBonus;
    }

    /**
     * @param string $versatilityDamageDoneBonus
     * @return Stats
     */
    public function setVersatilityDamageDoneBonus(?string $versatilityDamageDoneBonus): self
    {
        $this->versatilityDamageDoneBonus = $versatilityDamageDoneBonus;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersatilityHealingDoneBonus(): ?string
    {
        return $this->versatilityHealingDoneBonus;
    }

    /**
     * @param string $versatilityHealingDoneBonus
     * @return Stats
     */
    public function setVersatilityHealingDoneBonus(?string $versatilityHealingDoneBonus): self
    {
        $this->versatilityHealingDoneBonus = $versatilityHealingDoneBonus;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersatilityDamageTakenBonus(): ?string
    {
        return $this->versatilityDamageTakenBonus;
    }

    /**
     * @param string $versatilityDamageTakenBonus
     * @return Stats
     */
    public function setVersatilityDamageTakenBonus(?string $versatilityDamageTakenBonus): self
    {
        $this->versatilityDamageTakenBonus = $versatilityDamageTakenBonus;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvoidanceRating(): ?string
    {
        return $this->avoidanceRating;
    }

    /**
     * @param string $avoidanceRating
     * @return Stats
     */
    public function setAvoidanceRating(?string $avoidanceRating): self
    {
        $this->avoidanceRating = $avoidanceRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvoidanceRatingBonus(): ?string
    {
        return $this->avoidanceRatingBonus;
    }

    /**
     * @param string $avoidanceRatingBonus
     * @return Stats
     */
    public function setAvoidanceRatingBonus(?string $avoidanceRatingBonus): self
    {
        $this->avoidanceRatingBonus = $avoidanceRatingBonus;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpellPen(): ?string
    {
        return $this->spellPen;
    }

    /**
     * @param string $spellPen
     * @return Stats
     */
    public function setSpellPen(?string $spellPen): self
    {
        $this->spellPen = $spellPen;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpellCrit(): ?string
    {
        return $this->spellCrit;
    }

    /**
     * @param string $spellCrit
     * @return Stats
     */
    public function setSpellCrit(?string $spellCrit): self
    {
        $this->spellCrit = $spellCrit;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpellCritRating(): ?string
    {
        return $this->spellCritRating;
    }

    /**
     * @param string $spellCritRating
     * @return Stats
     */
    public function setSpellCritRating(?string $spellCritRating): self
    {
        $this->spellCritRating = $spellCritRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getMana5(): ?string
    {
        return $this->mana5;
    }

    /**
     * @param string $mana5
     * @return Stats
     */
    public function setMana5(?string $mana5): self
    {
        $this->mana5 = $mana5;

        return $this;
    }

    /**
     * @return string
     */
    public function getMana5Combat(): ?string
    {
        return $this->mana5Combat;
    }

    /**
     * @param string $mana5Combat
     * @return Stats
     */
    public function setMana5Combat(?string $mana5Combat): self
    {
        $this->mana5Combat = $mana5Combat;

        return $this;
    }

    /**
     * @return string
     */
    public function getArmor(): ?string
    {
        return $this->armor;
    }

    /**
     * @param string $armor
     * @return Stats
     */
    public function setArmor(?string $armor): self
    {
        $this->armor = $armor;

        return $this;
    }

    /**
     * @return string
     */
    public function getDodge(): ?string
    {
        return $this->dodge;
    }

    /**
     * @param string $dodge
     * @return Stats
     */
    public function setDodge(?string $dodge): self
    {
        $this->dodge = $dodge;

        return $this;
    }

    /**
     * @return string
     */
    public function getDodgeRating(): ?string
    {
        return $this->dodgeRating;
    }

    /**
     * @param string $dodgeRating
     * @return Stats
     */
    public function setDodgeRating(?string $dodgeRating): self
    {
        $this->dodgeRating = $dodgeRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getParry(): ?string
    {
        return $this->parry;
    }

    /**
     * @param string $parry
     * @return Stats
     */
    public function setParry(?string $parry): self
    {
        $this->parry = $parry;

        return $this;
    }

    /**
     * @return string
     */
    public function getParryRating(): ?string
    {
        return $this->parryRating;
    }

    /**
     * @param string $parryRating
     * @return Stats
     */
    public function setParryRating(?string $parryRating): self
    {
        $this->parryRating = $parryRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getBlock(): ?string
    {
        return $this->block;
    }

    /**
     * @param string $block
     * @return Stats
     */
    public function setBlock(?string $block): self
    {
        $this->block = $block;

        return $this;
    }

    /**
     * @return string
     */
    public function getBlockRating(): ?string
    {
        return $this->blockRating;
    }

    /**
     * @param string $blockRating
     * @return Stats
     */
    public function setBlockRating(?string $blockRating): self
    {
        $this->blockRating = $blockRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainHandDmgMin(): ?string
    {
        return $this->mainHandDmgMin;
    }

    /**
     * @param string $mainHandDmgMin
     * @return Stats
     */
    public function setMainHandDmgMin(?string $mainHandDmgMin): self
    {
        $this->mainHandDmgMin = $mainHandDmgMin;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainHandDmgMax(): ?string
    {
        return $this->mainHandDmgMax;
    }

    /**
     * @param string $mainHandDmgMax
     * @return Stats
     */
    public function setMainHandDmgMax(?string $mainHandDmgMax): self
    {
        $this->mainHandDmgMax = $mainHandDmgMax;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainHandSpeed(): ?string
    {
        return $this->mainHandSpeed;
    }

    /**
     * @param string $mainHandSpeed
     * @return Stats
     */
    public function setMainHandSpeed(?string $mainHandSpeed): self
    {
        $this->mainHandSpeed = $mainHandSpeed;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainHandDps(): ?string
    {
        return $this->mainHandDps;
    }

    /**
     * @param string $mainHandDps
     * @return Stats
     */
    public function setMainHandDps(?string $mainHandDps): self
    {
        $this->mainHandDps = $mainHandDps;

        return $this;
    }

    /**
     * @return string
     */
    public function getOffHandDmgMin(): ?string
    {
        return $this->offHandDmgMin;
    }

    /**
     * @param string $offHandDmgMin
     * @return Stats
     */
    public function setOffHandDmgMin(?string $offHandDmgMin): self
    {
        $this->offHandDmgMin = $offHandDmgMin;

        return $this;
    }

    /**
     * @return string
     */
    public function getOffHandDmgMax(): ?string
    {
        return $this->offHandDmgMax;
    }

    /**
     * @param string $offHandDmgMax
     * @return Stats
     */
    public function setOffHandDmgMax(?string $offHandDmgMax): self
    {
        $this->offHandDmgMax = $offHandDmgMax;

        return $this;
    }

    /**
     * @return string
     */
    public function getOffHandSpeed(): ?string
    {
        return $this->offHandSpeed;
    }

    /**
     * @param string $offHandSpeed
     * @return Stats
     */
    public function setOffHandSpeed(?string $offHandSpeed): self
    {
        $this->offHandSpeed = $offHandSpeed;

        return $this;
    }

    /**
     * @return string
     */
    public function getOffHandDps(): ?string
    {
        return $this->offHandDps;
    }

    /**
     * @param string $offHandDps
     * @return Stats
     */
    public function setOffHandDps(?string $offHandDps): self
    {
        $this->offHandDps = $offHandDps;

        return $this;
    }

    /**
     * @return string
     */
    public function getRangedDmgMin(): ?string
    {
        return $this->rangedDmgMin;
    }

    /**
     * @param string $rangedDmgMin
     * @return Stats
     */
    public function setRangedDmgMin(?string $rangedDmgMin): self
    {
        $this->rangedDmgMin = $rangedDmgMin;

        return $this;
    }

    /**
     * @return string
     */
    public function getRangedDmgMax(): ?string
    {
        return $this->rangedDmgMax;
    }

    /**
     * @param string $rangedDmgMax
     * @return Stats
     */
    public function setRangedDmgMax(?string $rangedDmgMax): self
    {
        $this->rangedDmgMax = $rangedDmgMax;

        return $this;
    }

    /**
     * @return string
     */
    public function getRangedSpeed(): ?string
    {
        return $this->rangedSpeed;
    }

    /**
     * @param string $rangedSpeed
     * @return Stats
     */
    public function setRangedSpeed(?string $rangedSpeed): self
    {
        $this->rangedSpeed = $rangedSpeed;

        return $this;
    }

    /**
     * @return string
     */
    public function getRangedDps(): ?string
    {
        return $this->rangedDps;
    }

    /**
     * @param string $rangedDps
     * @return Stats
     */
    public function setRangedDps(?string $rangedDps): self
    {
        $this->rangedDps = $rangedDps;

        return $this;
    }


}
