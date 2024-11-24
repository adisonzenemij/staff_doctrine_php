<?php
    namespace App\Entity\Technology;

    use Doctrine\ORM\Mapping as ORM;
    use Ramsey\Uuid\Guid\Guid;
    use Ramsey\Uuid\Guid\GuidInterface;

    /**
     * @ORM\Entity
     * @ORM\Table(name="tg_user_email")
    **/
    class TgUserEmailEntity {
        /**
         * @ORM\Id
         * @ORM\Column(type="guid", name="at_register")
         * @ORM\GeneratedValue(strategy="NONE")
         */
        private $atRegister;

        /**
         * @ORM\Column(type="string", name="fd_extra", length=255, nullable=true)
         */
        private $fdExtra;

        # Relaciones Mapeadas

        /**
         * @ORM\ManyToOne(targetEntity="TgUserDataEntity")
         * @ORM\JoinColumn(name="tg_user_data", nullabe=false, referencedColumnName="atRegister")
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
        public function getFdExtra() {
            return $this->fdExtra;
        }

        # Capturar valores del registro
        public function setFdExtra($fdExtra) {
            $this->fdExtra = $fdExtra;
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
?>
