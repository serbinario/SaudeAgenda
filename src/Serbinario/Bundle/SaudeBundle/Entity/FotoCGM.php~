<?php
namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FotoCGM 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;
    
    
    /**
     * @Assert\File(
     *  maxSize="600000000000",
     *  mimeTypes = {
     *    "image/png",
     *    "image/jpeg",
     *    "image/jpg",
     *  },
     *  mimeTypesMessage = "Formato de imagem não compatível"
     * )
     */
    private $file;
    
    /**
     * @ORM\OneToOne(targetEntity="CGM", inversedBy="foto")
     * @ORM\JoinColumn(name="id_cgm", referencedColumnName="id_cgm", unique=false)
     **/
    private $cgm;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Documento
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Documento
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    } 
    
     /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
   /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * 
     * @return type
     */
    public function upload($newName)
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the md5(uniqid(null, true))
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $newName
        );
        // set the path property to the filename where you've saved the file
        $this->path = $newName;

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if (file_exists($file)) {
            unlink($file);
        }
    }
    
    /**
     * 
     * @param type $absolutePath
     */
    public function removeFile($absolutePath)
    {
        $file = $absolutePath;
        if (file_exists($file)) {
            unlink($file);
        }
    }


    /**
     * 
     * @return type
     */
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }
    
    /**
     * 
     * @return type
     */
    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    /**
     * 
     * @return type
     */
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    /**
     * 
     * @return string
     */
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/fotos';
    } 
    
    /**
     * 
     * @return type
     */
    function getCgm() {
        return $this->cgm;
    }
    
    /**
     * 
     * @param type $cgm
     */
    function setCgm($cgm) {
        $this->cgm = $cgm;
    }

}
