<?php

namespace BlogBundle\Entity;


class Post
{
///**
//* @ORM\Entity(repositoryClass="BlogBundle\Repository\PostRepository")
//* @ORM\Table(name="post")
//* @ORM\HasLifecycleCallbacks()
//*/
//    public function __construct()
//    {
//        $this->setTitle($title);
////        $this->setUpdated(new \DateTime());
//    }

//    /**
//     * @ORM\preUpdate
//     */
//    public function setUpdatedValue()
//    {
//        $this->setUpdated(new \DateTime());
//    }
//

    /**
     * Get post
     *
     * @return string
     */
    public function getPost($length = null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->post, 0, $length);
        else
        return $this->post;
    }

    ////////////////////////////////////////
    ////////////AUTO GENERATED /////////////
    ///////////////////////////////////////


    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $post;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \BlogBundle\Entity\Image
     */
    private $image;


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
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set post
     *
     * @param string $post
     *
     * @return Post
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Post
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set image
     *
     * @param \BlogBundle\Entity\Image $image
     *
     * @return Post
     */
    public function setImage(\BlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \BlogBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
