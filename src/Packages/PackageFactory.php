<?php declare(strict_types=1);

/*
 * This file is part of the Sericode package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sericode\Oss\Packages;

use Sericode\Oss\Contracts\PackageContract;
use Sericode\Oss\Contracts\PackageFactoryContract;

class PackageFactory implements PackageFactoryContract
{
    /**
     * @var PackageContract[]
     */
    protected $packages = [];

    /**
     * @param PackageContract[] $packages
     * @return void
     */
    public function __construct(array $packages)
    {
        $this->packages = $packages;
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->packages;
    }

    /**
     * {@inheritdoc}
     */
    public function find(string $name): PackageContract
    {
        foreach ($this->packages as $package) {
            if ($package->getName() === $name) {
                return $package;
            }
        }

        throw new NotFoundException(
            sprintf('The "%s" package was not found.', $name)
        );
    }
}
