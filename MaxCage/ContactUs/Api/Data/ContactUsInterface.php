<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MaxCage\ContactUs\Api\Data;

/**
 * Contact Us interface.
 * @api
 * @since 100.0.1
 */
interface ContactUsInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID      = 'entity_id';
    const NAME           = 'name';
    const TELEPHONE      = 'telephone';
    const EMAIL          = 'email';
    const MESSAGE        = 'message';
    const CREATION_TIME  = 'creation_time';
    const STATUS         = 'status';

    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get telephone
     *
     * @return string|null
     */
    public function getTelephone();

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Get creation_time
     *
     * @return string
     */
    public function getCreationTime();

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set ID
     *
     * @param int $id
     * @return ContactUsInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     * @return ContactUsInterface
     */
    public function setName($name);

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return ContactUsInterface
     */
    public function setTelephone($telephone);

    /**
     * Set email
     *
     * @param string $email
     * @return ContactUsInterface
     */
    public function setEmail($email);

    /**
     * Set message
     *
     * @param string $message
     * @return ContactUsInterface
     */
    public function setMessage($message);

    /**
     * Set creation_time
     *
     * @param string $creation_time
     * @return ContactUsInterface
     */
    public function setCreationTime($creation_time);

    /**
     * Set status
     *
     * @param string $status
     * @return ContactUsInterface
     */
    public function setStatus($status);
}
