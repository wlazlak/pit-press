<?php

//! @file TVersion.php
//! @brief This file contains the TVersion trait.
//! @details
//! @author Filippo F. Fadda


namespace PitPress\Extension;


//! @brief Implements IVersion interface.
trait TVersion {


  //! @copydoc IVersion
  public function getChanges() {
  }


  //! @copydoc IVersion
  public function rollback($version) {
  }

} 