<?php
namespace XinMo\ServicePlugin;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class ServiceInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        if ('xinmo/rpc' == $package->getPrettyName()) {
            return 'common/' . substr($package->getPrettyName(), 6);
        }

        $prefix = substr($package->getPrettyName(), 0, 14);
        if ('xinmo/service-' !== $prefix) {
            throw new \InvalidArgumentException('The package name:' . $prefix . ',unable to installed, should always start their package name with "xinmo/service-"');
        }

        return 'common/service/' . substr($package->getPrettyName(), 14);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'service-plugin' === $packageType;
    }
}
