<?php

namespace App\Test\Controller;

use App\Entity\Entrada;
use App\Repository\EntradaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntradaControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/entrada/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Entrada::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entrada index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'entrada[precio_compra]' => 'Testing',
            'entrada[fecha]' => 'Testing',
            'entrada[proyecto]' => 'Testing',
            'entrada[material]' => 'Testing',
            'entrada[Captura]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Entrada();
        $fixture->setPrecio_compra('My Title');
        $fixture->setFecha('My Title');
        $fixture->setProyecto('My Title');
        $fixture->setMaterial('My Title');
        $fixture->setCaptura('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entrada');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Entrada();
        $fixture->setPrecio_compra('Value');
        $fixture->setFecha('Value');
        $fixture->setProyecto('Value');
        $fixture->setMaterial('Value');
        $fixture->setCaptura('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'entrada[precio_compra]' => 'Something New',
            'entrada[fecha]' => 'Something New',
            'entrada[proyecto]' => 'Something New',
            'entrada[material]' => 'Something New',
            'entrada[Captura]' => 'Something New',
        ]);

        self::assertResponseRedirects('/entrada/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPrecio_compra());
        self::assertSame('Something New', $fixture[0]->getFecha());
        self::assertSame('Something New', $fixture[0]->getProyecto());
        self::assertSame('Something New', $fixture[0]->getMaterial());
        self::assertSame('Something New', $fixture[0]->getCaptura());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Entrada();
        $fixture->setPrecio_compra('Value');
        $fixture->setFecha('Value');
        $fixture->setProyecto('Value');
        $fixture->setMaterial('Value');
        $fixture->setCaptura('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/entrada/');
        self::assertSame(0, $this->repository->count([]));
    }
}
