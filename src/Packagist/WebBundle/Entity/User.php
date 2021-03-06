<?php

/*
 * This file is part of Packagist.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *     Nils Adermann <naderman@naderman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Packagist\WebBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Packagist\WebBundle\Entity\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Package", mappedBy="maintainers")
     */
    private $packages;

    /**
     * @ORM\OneToMany(targetEntity="Packagist\WebBundle\Entity\Author", mappedBy="owner")
     */
    private $authors;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @var string
     */
    private $apiToken;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $githubId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $githubToken;

    /**
     * @ORM\Column(type="boolean", options={"default"=true})
     * @var string
     */
    private $failureNotifications = true;

    public function __construct()
    {
        $this->packages = new ArrayCollection();
        $this->authors = new ArrayCollection();
        $this->createdAt = new \DateTime();
        parent::__construct();
    }

    public function toArray()
    {
        return array(
            'name' => $this->getUsername(),
        );
    }

    /**
     * Add packages
     *
     * @param \Packagist\WebBundle\Entity\Package $packages
     */
    public function addPackages(Package $packages)
    {
        $this->packages[] = $packages;
    }

    /**
     * Get packages
     *
     * @return \Doctrine\Common\Collections\Collection $packages
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * Add authors
     *
     * @param \Packagist\WebBundle\Entity\Author $authors
     */
    public function addAuthors(\Packagist\WebBundle\Entity\Author $authors)
    {
        $this->authors[] = $authors;
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set apiToken
     *
     * @param string $apiToken
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * Get apiToken
     *
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * Get githubId.
     *
     * @return string
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * Set githubId.
     *
     * @param string $githubId
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;
    }

    /**
     * Get githubId.
     *
     * @return string
     */
    public function getGithubToken()
    {
        return $this->githubToken;
    }

    /**
     * Set githubToken.
     *
     * @param string $githubToken
     */
    public function setGithubToken($githubToken)
    {
        $this->githubToken = $githubToken;
    }

    /**
     * Set failureNotifications
     *
     * @param Boolean $failureNotifications
     */
    public function setFailureNotifications($failureNotifications)
    {
        $this->failureNotifications = $failureNotifications;
    }

    /**
     * Get failureNotifications
     *
     * @return Boolean
     */
    public function getFailureNotifications()
    {
        return $this->failureNotifications;
    }

    /**
     * Get failureNotifications
     *
     * @return Boolean
     */
    public function isNotifiableForFailures()
    {
        return $this->failureNotifications;
    }
}
