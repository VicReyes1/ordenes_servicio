<?php

namespace App\Test\Controller;

use App\Entity\Material;
use App\Repository\MaterialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MaterialControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/material/crud/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Material::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Material index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'material[nombre]' => 'Testing',
            'material[unidad_medida]' => 'Testing',
            'material[precio]' => 'Testing',
            'material[categoria]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Material();
        $fixture->setNombre('My Title');
        $fixture->setUnidad_medida('My Title');
        $fixture->setPrecio('My Title');
        $fixture->setCategoria('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Material');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Material();
        $fixture->setNombre('Value');
        $fixture->setUnidad_medida('Value');
        $fixture->setPrecio('Value');
        $fixture->setCategoria('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'material[nombre]' => 'Something New',
            'material[unidad_medida]' => 'Something New',
            'material[precio]' => 'Something New',
            'material[categoria]' => 'Something New',
        ]);

        self::assertResponseRedirects('/material/crud/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNombre());
        self::assertSame('Something New', $fixture[0]->getUnidad_medida());
        self::assertSame('Something New', $fixture[0]->getPrecio());
        self::assertSame('Something New', $fixture[0]->getCategoria());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Material();
        $fixture->setNombre('Value');
        $fixture->setUnidad_medida('Value');
        $fixture->setPrecio('Value');
        $fixture->setCategoria('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/material/crud/');
        self::assertSame(0, $this->repository->count([]));
    }
}
