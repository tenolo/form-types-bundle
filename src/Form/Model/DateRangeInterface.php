<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Model;

/**
 * Interface DateRangeInterface
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Model
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface DateRangeInterface
{

    /**
     * @return bool
     */
    public function hasStart();

    /**
     * @param \DateTime $start
     */
    public function setStart(\DateTime $start = null);

    /**
     * @return \DateTime
     */
    public function getStart();

    /**
     * @return bool
     */
    public function hasEnd();

    /**
     * @param \DateTime $end
     */
    public function setEnd(\DateTime $end = null);

    /**
     * @return \DateTime
     */
    public function getEnd();
}
