<?php

namespace App\DataTransformer;

use App\Entity\Feed;
use App\Utils\BattleNetSDK;

class FeedTransformer extends AbstractTransformer
{
    /** @var AchievementTransformer $achievementTransformer */
    private $achievementTransformer;

    /**
     * FeedTransformer constructor.
     * @param AchievementTransformer $achievementTransformer
     */
    public function __construct(AchievementTransformer $achievementTransformer)
    {
        parent::__construct();
        $this->achievementTransformer = $achievementTransformer;
    }

    /**
     * @param $data
     * @param null $character
     * @return Feed
     */
    public function transformItem($data, $character = null)
    {
        $feed = $this->fillPropertiesClosure($data, new Feed(), function ($item, $key) {
            return $key == 'achievement' ? $this->achievementTransformer->transformItem($item) : $item;
        });

        $feed->setDate(BattleNetSDK::timestampToDate($data['timestamp']));
        $feed->setCharacter($character);

        return $feed;
    }

    /**
     * @param $data
     * @return array
     */
    public function transformCollection($data)
    {
        $character = $data['name'];
        $data = $data['feed'] ?? $data;
        $data = array_map(function ($data) use($character) {
            return $this->transformItem($data, $character);
        }, $data);

        return $data;
    }
}
