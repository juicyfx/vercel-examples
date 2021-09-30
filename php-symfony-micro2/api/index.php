<?php

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

require __DIR__ . '/../vendor/autoload.php';

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getCacheDir()
    {
        if(isset($_ENV['NOW_REGION'])){
            return '/tmp/symfony/cache/'.$this->environment;
        }

        return $this->getProjectDir().'/var/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        if(isset($_ENV['NOW_REGION'])){
            return '/tmp/symfony/log';
        }

        return $this->getProjectDir().'/var/log';
    }

    public function registerBundles(): array
    {
        return [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
        ];
    }

    protected function configureContainer(ContainerConfigurator $c): void
    {
        // PHP equivalent of config/packages/framework.yaml
        $c->extension('framework', [
            'secret' => 'S0ME_SECRET'
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->add('index', '/')->controller([$this, 'handlerIndex']);
        $routes->add('random_number', '/random/{limit}')->controller([$this, 'handlerRandomNumber']);
    }

    public function handlerIndex(): JsonResponse
    {
        return new JsonResponse([
            'hello' => 'world',
        ]);
    }

    public function handlerRandomNumber(int $limit): JsonResponse
    {
        return new JsonResponse([
            'number' => random_int(0, $limit),
        ]);
    }
}

$kernel = new Kernel('dev', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
