<?php

namespace Forix\Unit05\Api\Data;

interface TrainingInterface
{
    /**
     * @param int $id
     * @return TrainingInterface
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $name
     * @return TrainingInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $createdAt
     * @return TrainingInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $updatedAt
     * @return TrainingInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @return string
     */
    public function getUpdatedAt();
}
