<?php
    namespace App\Entity;

    use Ramsey\Uuid\Guid\Guid;
    use Ramsey\Uuid\Guid\GuidInterface;
    use Doctrine\ORM\Mapping as mappign;

    /**
     * @ORM\Entity
     * @ORM\Table(name="tg_user_data")
    **/
    class TgUserDataEntity {
        /**
         * @ORM\Id
         * @ORM\Column(type="guid", name="at_register")
         * @ORM\GeneratedValue(strategy="NONE")
         */
        private $atRegister;

        /**
         * @ORM\Column(type="string", name="fd_email", length=255, nullable=true)
         */
        private $fdEmail;

        /**
         * @ORM\Column(type="string", name="fd_login", length=255, nullable=true)
         */
        private $fdLogin;

        /**
         * @ORM\Column(type="string", name="fd_pass", length=255, nullable=true)
         */
        private $fdPass;

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
        public function getFdEmail() {
            return $this->fdEmail;
        }

        # Capturar valores del registro
        public function setFdEmail($fdEmail) {
            $this->fdEmail = $fdEmail;
        }

        # Obtener valores del registro
        public function getFdLogin() {
            return $this->fdLogin;
        }

        # Capturar valores del registro
        public function setFdLogin($fdLogin) {
            $this->fdLogin = $fdLogin;
        }

        # Obtener valores del registro
        public function getFdPass() {
            return $this->fdPass;
        }

        # Capturar valores del registro
        public function setFdPass($fdPass) {
            $this->fdPass = $fdPass;
        }
    }
