<?php

/*
The MIT License (MIT)

Copyright (c) 2015-2017 Jacques Archimède

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

namespace EUREKA\G6KBundle\Entity;

/**
 * This class allows the storage and retrieval of the attributes of a block of information (blockinfo)
 *
 * The blockinfo is an element of the simulation page of the same level as the field group but does not contain any input or output fields.
 * It contains textual information that can be useful to the user in the simulation process. 
 * It can be contextualized by showing / hiding it totally or partially using the actions of business rules depending on certain conditions.
 *
 * @author    Jacques Archimède
 *
 */
class BlockInfo {

	/**
	 * @var \EUREKA\G6KBundle\Entity\Panel $panel Panel that contains this blockinfo
	 *
	 * @access  private
	 *
	 */
	private $panel = null;

	/**
	 * @var int        $id Blockinfo id 
	 *
	 * @access  private
	 *
	 */
	private $id = 0;

	/**
	 * @var string     $name Blockinfo name without spaces or special or accented characters
	 *
	 * @access  private
	 *
	 */
	private $name = "";

	/**
	 * @var string     $label Blockinfo label
	 *
	 * @access  private
	 *
	 */
	private $label = "";

	/**
	 * @var array      $chapters Array of Chapter objects 
	 *
	 * @access  private
	 *
	 */
	private $chapters = array();

	/**
	 * @var bool       $displayable Blockinfo displayable or not
	 *
	 * @access  private
	 *
	 */
	private $displayable = true;

	/**
	 * Constructor of class BlockInfo
	 *
	 * @access  public
	 * @param   \EUREKA\G6KBundle\Entity\Panel $panel Panel that contains this blockinfo
	 * @param   int        $id Blockinfo id
	 * @return  void
	 *
	 */
	public function __construct($panel, $id) {
		$this->panel = $panel;
		$this->id = $id;
	}

	/**
	 * Returns the Panel object that contains this BlockInfo object
	 *
	 * @access  public
	 * @return  EUREKA\G6KBundle\Entity\Panel The container Panel of this BlockInfo object
	 *
	 */
	public function getPanel() {
		return $this->panel;
	}

	/**
	 * Returns the ID of this BlockInfo object
	 *
	 * @access  public
	 * @return  int the value of id
	 *
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Sets the ID of this BlockInfo object
	 *
	 * @access  public
	 * @param   int        $id Blockinfo id
	 * @return  void
	 *
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Returns the name of this BlockInfo object
	 *
	 * @access  public
	 * @return  string the value of name
	 *
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name of this BlockInfo object
	 *
	 * @access  public
	 * @param   string     $name Blockinfo name without spaces or special or accented characters
	 * @return  void
	 *
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the label of this BlockInfo object
	 *
	 * @access  public
	 * @return  string the value of label
	 *
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * Sets the label of this BlockInfo object
	 *
	 * @access  public
	 * @param   string     $label Blockinfo label
	 * @return  void
	 *
	 */
	public function setLabel($label) {
		$this->label = $label;
	}

	/**
	 * Returns the list of chapters contained in this BlockInfo object
	 *
	 * @access  public
	 * @return  array the value of chapters
	 *
	 */
	public function getChapters() {
		return $this->chapters;
	}

	/**
	 * Sets the list of chapters contained in this BlockInfo object
	 *
	 * @access  public
	 * @param   array      $chapters Array of Chapter objects 
	 * @return  void
	 *
	 */
	public function setChapters($chapters) {
		$this->chapters = $chapters;
	}

	/**
	 * Adds a chapter to the list of chapters contained in this BlockInfo object
	 *
	 * @access  public
	 * @param   EUREKA\G6KBundle\Entity\Chapter $chapter
	 * @return  void
	 *
	 */
	public function addChapter($chapter) {
		$this->chapters[] = $chapter;
	}

	/**
	 * Removes a chapter from the list of chapters contained in this BlockInfo object
	 *
	 * @access  public
	 * @param   int $index Index of the chapter to remove
	 * @return  void
	 *
	 */
	public function removeChapter($index) {
		$this->chapters[$index] = null;
	}

	/**
	 * Retrieves a chapter by its ID in the chapter list of this BlockInfo object
	 *
	 * @access  public
	 * @param   int $id Chapter id
	 * @return  \EUREKA\G6KBundle\Entity\Chapter|null The chapter with this ID
	 *
	 */
	public function getChapterById($id) {
		foreach ($this->chapters as $chapter) {
			if ($chapter->getId() == $id) {
				return $chapter;
			}
		}
		return null;
	}

	/**
	 * Returns the displayable attribute of this BlockInfo object 
	 *
	 * @access  public
	 * @return  bool the value of displayable
	 *
	 */
	public function isDisplayable() {
		return $this->displayable;
	}

	/**
	 * Returns the displayable attribute of this BlockInfo object 
	 *
	 * @access  public
	 * @return  bool the value of displayable
	 *
	 */
	public function getDisplayable() {
		return $this->displayable;
	}

	/**
	 * Determines whether this BlockInfo can be displayed or not
	 *
	 * @access  public
	 * @param   bool       $displayable Blockinfo displayable or not
	 * @return  void
	 *
	 */
	public function setDisplayable($displayable) {
		$this->displayable = $displayable;
	}

	/**
	 * Returns the class name of this BlockInfo object 
	 *
	 * @access  public
	 * @return  string the class name
	 *
	 */
	public function getClass() {
		$classPath = explode('\\', get_class());
		return end($classPath);
	}

}

?>
