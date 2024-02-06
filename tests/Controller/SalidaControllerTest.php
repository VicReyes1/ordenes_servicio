<?php

namespace App\Test\Controller;

use App\Entity\Salida;
use App\Repository\SalidaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SalidaControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/salida/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Salida::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Salida index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'salida[precio_salida]' => 'Testing',
            'salida[fecha]' => 'Testing',
            'salida[cantidad]' => 'Testing',
            'salida[material]' => 'Testing',
            'salida[captura]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Salida();
        $fixture->setPrecio_salida('My Title');
        $fixture->setFecha('My Title');
        $fixture->setCantidad('My Title');
        $fixture->setMaterial('My Title');
        $fixture->setCaptura('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Salida');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Salida();
        $fixture->setPrecio_salida('Value');
        $fixture->setFecha('Value');
        $fixture->setCantidad('Value');
        $fixture->setMaterial('Value');
        $fixture->setCaptura('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'salida[precio_salida]' => 'Something New',
            'salida[fecha]' => 'Something New',
            'salida[cantidad]' => 'Something New',
            'salida[material]' => 'Something New',
            'salida[captura]' => 'Something New',
        ]);

        self::assertResponseRedirects('/salida/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPrecio_salida());
        self::assertSame('Something New', $fixture[0]->getFecha());
        self::assertSame('Something New', $fixture[0]->getCantidad());
        self::assertSame('Something New', $fixture[0]->getMaterial());
        self::assertSame('Something New', $fixture[0]->getCaptura());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Salida();
        $fixture->setPrecio_salida('Value');
        $fixture->setFecha('Value');
        $fixture->setCantidad('Value');
        $fixture->setMaterial('Value');
        $fixture->setCaptura('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/salida/');
        self::assertSame(0, $this->repository->count([]));
    }
}
