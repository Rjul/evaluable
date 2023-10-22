<?php

namespace App\Entity\Trait;

use Symfony\Component\String\Slugger\AsciiSlugger;
use Doctrine\ORM\Mapping as ORM;

/**
 * Implementation of slugableInterface required
 *
 * Trait SlugableTrait
 * @package App\Entity\Trait
 */

trait SlugableTrait
{

    #[ORM\Column (length: 250)]
    private ?string $slug = null;

    public function slugify()
    {
        $slug = '';
        foreach ($this->getFieldToSlug() as $field) {
            $getter = 'get' . ucfirst($field);
            $slug .= $this->$getter() . ' ';
        }
        $this->slug = (new AsciiSlugger())->slug($slug);
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return SlugableTrait
     */
    public function setSlug(?string $slug): SlugableTrait
    {
        $this->slug = $slug;
        return $this;
    }



}
