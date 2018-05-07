<?php

/*
 * This file is part of the `liip/LiipImagineBundle` project.
 *
 * (c) https://github.com/liip/LiipImagineBundle/graphs/contributors
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Liip\ImagineBundle\Imagine\Filter\Loader;

use Imagine\Filter\Basic\Crop;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;

class CropFilterLoader implements LoaderInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ImageInterface $image, array $options = [])
    {
        $width = isset($options['size'][0]) ? $options['size'][0] : null;
        $height = isset($options['size'][1]) ? $options['size'][1] : null;

        $size = $image->getSize();
        $origWidth = $size->getWidth();
        $origHeight = $size->getHeight();

        $deltaWidth = $origWidth - $options['size'][0];
        $x = $deltaWidth / 2;

        $deltaHeight = $origHeight - $options['size'][1];
        $y = $deltaHeight / 2;


        $filter = new Crop(new Point($x, $y), new Box($width, $height));

        $image = $filter->apply($image);

        return $image;
    }
}
