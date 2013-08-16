<?php

//! @file IStar.php
//! @brief This file contains the IStar interface.
//! @details
//! @author Filippo F. Fadda


namespace PitPress\Extension;


use PitPress\Model\User\User;


//! @brief Defines starring methods.
//! @nosubgrouping
interface IStar {

  //! @name Starring Methods
  //@{

  //! @brief Returns `true` if the current user starred this post.
  //! @param[in] User $currentUser The current user logged in.
  //! @param[out] string $starId The star document identifier related to the current post.
  //! @return boolean
  public function isStarred(User $currentUser, &$starId = NULL);


  //! @brief Adds the item to the favourites list of the current user.
  //! @param[in] User $currentUser The current user logged in.
  public function star(User $currentUser);


  //! @brief Removes the item from the favourites list of the current user.
  //! @param[in] User $currentUser The current user logged in.
  public function unstar(User $currentUser);


  //! @brief Returns the number of times the item has been starred.
  //! @return integer
  public function getStarsCount();

  //! @}

} 