<?php
    namespace App\Entity;

    use Ramsey\Uuid\Guid\Guid;
    use Ramsey\Uuid\Guid\GuidInterface;
    use Doctrine\ORM\Mapping as mappign;

    /**
     * @ORM\Entity
     * @ORM\Table(name="tg_user_ip")
    **/
    class TgUserIpEntity {
        /**
         * @ORM\Id
         * @ORM\Column(type="guid", name="at_register")
         * @ORM\GeneratedValue(strategy="NONE")
         */
        private $atRegister;

        /**
         * @ORM\Column(type="string", name="fd_address", length=255, nullable=true)
         */
        private $fdAddress;

        /**
         * @ORM\OneToMany(targetEntity="TgUserDataEntity", mappedBy="tgUserData")
         */
        private $tgUserData;

        # Constructor para generar el UUID automáticamente al crear la entidad
        public function __construct() {
            if (is_null($this->atRegister)) {
                # Generar UUID automáticamente
                $this->atRegister = Guid::uuid4()->toString();
            }
        }

        # Obtener valores del registro
        public function getAtRegister() {
            return $this->atRegister;
        }

        # Capturar valores del registro
        public function setAtRegister($atRegister) {
            $this->atRegister = $atRegister;
        }

        # Obtener valores del registro
        public function getFdAddress() {
            return $this->fdAddress;
        }

        # Capturar valores del registro
        public function setFdAddress($fdAddress) {
            $this->fdAddress = $fdAddress;
        }

        # Relaciones Mapeadas

        # Obtener valores del registro
        public function getTgUserData() {
            return $this->tgUserData;
        }

        # Capturar valores del registro
        public function setTgUserData($tgUserData) {
            $this->tgUserData = $tgUserData;
        }
    }
