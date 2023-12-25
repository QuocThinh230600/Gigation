<?php

namespace App\Repositories\Image;

use App\Models\Image;
use App\Repositories\AbstractRepository;

class EloquentImage extends AbstractRepository implements ImageRepository
{
    protected $model;

    /**
     * EloquentImage constructor.
     * @param Image $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    /**
     * Get max position by position
     * @param int $position
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getMaxPosition(int $position): int
    {
        $position = $this->model->where("position_id", $position)->max('position');
        return $position + 1;
    }

    /**
     * Get all image with position
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllImageWithPosition(): object
    {
        return $this->model->with('position_image');
    }

    public function getImageWithPositionFirst($position_id, $position)
    {
        return $this->model->with('position_image')->where('position_id', $position_id)->where('position', $position)->first();
    }

    public function getImageWithPositionGet($position_id, $position)
    {
        return $this->model->with('position_image')->where('position_id', $position_id)->where('position', $position)->where('status','=', 'on')->get();
    }
}
