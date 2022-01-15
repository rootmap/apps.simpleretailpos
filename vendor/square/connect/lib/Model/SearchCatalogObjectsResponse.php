<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * SearchCatalogObjectsResponse Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class SearchCatalogObjectsResponse implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'errors' => '\SquareConnect\Model\Error[]',
        'cursor' => 'string',
        'objects' => '\SquareConnect\Model\CatalogObject[]',
        'related_objects' => '\SquareConnect\Model\CatalogObject[]',
        'latest_time' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'errors' => 'errors',
        'cursor' => 'cursor',
        'objects' => 'objects',
        'related_objects' => 'related_objects',
        'latest_time' => 'latest_time'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'errors' => 'setErrors',
        'cursor' => 'setCursor',
        'objects' => 'setObjects',
        'related_objects' => 'setRelatedObjects',
        'latest_time' => 'setLatestTime'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'errors' => 'getErrors',
        'cursor' => 'getCursor',
        'objects' => 'getObjects',
        'related_objects' => 'getRelatedObjects',
        'latest_time' => 'getLatestTime'
    );
  
    /**
      * $errors Information on any errors encountered.
      * @var \SquareConnect\Model\Error[]
      */
    protected $errors;
    /**
      * $cursor The pagination cursor to be used in a subsequent request. If unset, this is the final response. See [Pagination](https://developer.squareup.com/docs/basics/api101/pagination) for more information.
      * @var string
      */
    protected $cursor;
    /**
      * $objects The CatalogObjects returned.
      * @var \SquareConnect\Model\CatalogObject[]
      */
    protected $objects;
    /**
      * $related_objects A list of CatalogObjects referenced by the objects in the `objects` field.
      * @var \SquareConnect\Model\CatalogObject[]
      */
    protected $related_objects;
    /**
      * $latest_time When the associated product catalog was last updated. Will match the value for `end_time` or `cursor` if either field is included in the `SearchCatalog` request.
      * @var string
      */
    protected $latest_time;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initializing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            if (isset($data["errors"])) {
              $this->errors = $data["errors"];
            } else {
              $this->errors = null;
            }
            if (isset($data["cursor"])) {
              $this->cursor = $data["cursor"];
            } else {
              $this->cursor = null;
            }
            if (isset($data["objects"])) {
              $this->objects = $data["objects"];
            } else {
              $this->objects = null;
            }
            if (isset($data["related_objects"])) {
              $this->related_objects = $data["related_objects"];
            } else {
              $this->related_objects = null;
            }
            if (isset($data["latest_time"])) {
              $this->latest_time = $data["latest_time"];
            } else {
              $this->latest_time = null;
            }
        }
    }
    /**
     * Gets errors
     * @return \SquareConnect\Model\Error[]
     */
    public function getErrors()
    {
        return $this->errors;
    }
  
    /**
     * Sets errors
     * @param \SquareConnect\Model\Error[] $errors Information on any errors encountered.
     * @return $this
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }
    /**
     * Gets cursor
     * @return string
     */
    public function getCursor()
    {
        return $this->cursor;
    }
  
    /**
     * Sets cursor
     * @param string $cursor The pagination cursor to be used in a subsequent request. If unset, this is the final response. See [Pagination](https://developer.squareup.com/docs/basics/api101/pagination) for more information.
     * @return $this
     */
    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        return $this;
    }
    /**
     * Gets objects
     * @return \SquareConnect\Model\CatalogObject[]
     */
    public function getObjects()
    {
        return $this->objects;
    }
  
    /**
     * Sets objects
     * @param \SquareConnect\Model\CatalogObject[] $objects The CatalogObjects returned.
     * @return $this
     */
    public function setObjects($objects)
    {
        $this->objects = $objects;
        return $this;
    }
    /**
     * Gets related_objects
     * @return \SquareConnect\Model\CatalogObject[]
     */
    public function getRelatedObjects()
    {
        return $this->related_objects;
    }
  
    /**
     * Sets related_objects
     * @param \SquareConnect\Model\CatalogObject[] $related_objects A list of CatalogObjects referenced by the objects in the `objects` field.
     * @return $this
     */
    public function setRelatedObjects($related_objects)
    {
        $this->related_objects = $related_objects;
        return $this;
    }
    /**
     * Gets latest_time
     * @return string
     */
    public function getLatestTime()
    {
        return $this->latest_time;
    }
  
    /**
     * Sets latest_time
     * @param string $latest_time When the associated product catalog was last updated. Will match the value for `end_time` or `cursor` if either field is included in the `SearchCatalog` request.
     * @return $this
     */
    public function setLatestTime($latest_time)
    {
        $this->latest_time = $latest_time;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this));
        }
    }
}