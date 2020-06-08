<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
     * @param String $texte
     * @return array
     */
    public function findProduitsByLibelleOrTexte(String $texte): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
                 FROM App\Entity\Produit p
                 WHERE p.libelle LIKE :texte
                 OR p.texte LIKE :texte
                 ORDER BY p.libelle ASC'
        )->setParameter('texte', '%'.$texte.'%');

        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function findProduitsPlusVendus()
    {
        return $this->createQueryBuilder('p')
            ->addSelect('SUM(l.quantite) as quantite')
            ->join('p.ligneCommandes', 'l')
            ->groupBy('l.produit')
            ->orderBy('quantite', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

}
