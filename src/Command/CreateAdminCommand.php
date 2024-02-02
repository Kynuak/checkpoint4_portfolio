<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Créer un utilisateur avec le role admin',
)]
class CreateAdminCommand extends Command
{

    private SymfonyStyle $io;

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL, "l'email")
            ->addArgument('password', InputArgument::OPTIONAL, "le password")
        ;
    }

        protected function initialize(InputInterface $input, OutputInterface $output)
        {
            $this->io = new SymfonyStyle($input, $output);
        }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if(
            null != $input->getArgument('email') && 
            null != $input->getArgument('password')
        ) {
            return;
        }

        $this->io->text("Add admin command interactive wizard");
        $this->askArgument($input, 'email');
        $this->askArgument($input, 'password', true);
    }

    private function askArgument(InputInterface $input, string $name, bool $hidden = false): void
    {
        $value = strval($input->getArgument($name));
        if("" != $value) {
            $this->io->text((sprintf('> <info>%s</info>: %s', $name, $value)));
        } else {
            $value = match($hidden) {
                false => $this->io->ask($name),
                default => $this->io->askHidden($name)
            };
            $input->setArgument($name, $value);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setEmail(strval($input->getArgument('email')));
        $user->setPassword(
            $this->hasher->hashPassword($user, strval($input->getArgument('password')))
        );

        $user->setRoles(['ROLE_ADMIN']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
