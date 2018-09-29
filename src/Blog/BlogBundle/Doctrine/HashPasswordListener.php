<?php
/**
 * Created by PhpStorm.
 * User: ibou
 * Date: 18-09-18
 * Time: 16:16
 */
namespace Mairie\MairieBundle\Entity {
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
    use Doctrine\ORM\Event\LifecycleEventArgs;
    use Doctrine\Common\EventSubscriber;


    /**
     * @method encodePassword($entity)
     */
    class HashPasswordListener implements EventSubscriber
    {
        private $passwordEncoder;

        /**
         * HashPasswordListener constructor.
         * @param UserPasswordEncoder $passwordEncoder
         */
        public function __construct(UserPasswordEncoder $passwordEncoder)
        {
            $this->passwordEncoder =$passwordEncoder;
        }

        /**
         * @param LifecycleEventArgs $args
         */
        public function prePersist(LifecycleEventArgs $args)
        {
            $entity = $args->getEntity();
            if (!$entity instanceof User) {
                return;
            }
            $encoded = $this->passwordEncoder->encodePassword(
                $entity->getPlainPassword(), $entity
            );
            $this->encodePassword($entity);
            $entity->setPassword($encoded);
        }

        /**
         * Returns an array of events this subscriber wants to listen to.
         *
         * @return string[]
         */
        public function getSubscribedEvents()
        {
            // TODO: Implement getSubscribedEvents() method.
        }
    }
}