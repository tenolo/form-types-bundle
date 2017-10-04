<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Model;

/**
 * Class DateRange
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Model
 * @author  Nikita Loges
 */
class DateRange implements DateRangeInterface
{

    /** @var \DateTime|null */
    protected $start;

    /** @var \DateTime|null */
    protected $end;

    /**
     * @param \DateTime $start
     * @param \DateTime $end
     */
    public function __construct(\DateTime $start = null, \DateTime $end = null)
    {
        $this->setStart($start);
        $this->setEnd($end);
    }

    /**
     * @return bool
     */
    public function hasStart()
    {
        return !is_null($this->start);
    }

    /**
     * @param \DateTime $start
     */
    public function setStart(\DateTime $start = null)
    {
        if (!is_null($this->end) && $this->end < $start) {
            $this->end = $start;
        }

        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return bool
     */
    public function hasEnd()
    {
        return !is_null($this->end);
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd(\DateTime $end = null)
    {
        if (!is_null($this->start) && $this->start > $end) {
            $this->start = $end;
        }

        $this->end = $end;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
} 