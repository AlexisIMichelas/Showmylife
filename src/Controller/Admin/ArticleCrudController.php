<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Repository\CategoryRepository;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

#[IsGranted('ROLE_ADMIN')]
class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('description'),
            TextField::new('posterFile')->setFormType(VichImageType::class)->onlyWhenCreating(),
            ImageField::new ('poster')
                ->setBasePath('uploads/images/posters/') // Définir le chemin de base pour l'affichage de l'image
                ->setUploadDir('public/uploads/images/posters/'),
            AssociationField::new('category')
                ->setFormTypeOptions([
                    'query_builder' => function (CategoryRepository $categoryRepository) {
                        return $categoryRepository->createQueryBuilder('c')
                            ->orderBy('c.name', 'ASC');
                    },
                ]),
        ];
    }
}
