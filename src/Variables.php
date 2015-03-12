<?php
/**
 * @file
 * Variables.php
 *
 * @author: Frédéric G. MARAND <fgm@osinet.fr>
 *
 * @copyright (c) 2015 Ouest Systèmes Informatiques (OSInet).
 *
 * @license General Public License version 2 or later
 */

namespace OSInet\TwigDemo;

class Variables implements \ArrayAccess {
  protected $user = [];

  public function load($file) {
    $skipped = ['file', 'skipped', 'this', 'vars'];
    if (is_readable($file)) {
      $vars = require_once $file;
      foreach ($vars as $name => $value) {
        if (in_array($name, $skipped)) {
          continue;
        }
        $this[$name] = $value;
      }
    }
  }

  public function offsetGet($name) {
    return isset($this->user[$name])
      ? $this->user[$name]
      : NULL;
  }

  public function offsetSet($name, $value) {
    $this->user[$name] = $value;
  }

  public function offsetUnset($name) {
    unset($this->user[$name]);
  }

  public function offsetExists($name) {
    return array_key_exists($name, $this->user);
  }

  public function hash() {
    $ret = $this->user;
    return $ret;
  }
}
