<?php
/**
 * Autogenerated by Thrift
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';


$GLOBALS['E_TTypeTag'] = array(
  'T_VOID' => 1,
  'T_BOOL' => 2,
  'T_BYTE' => 3,
  'T_I16' => 6,
  'T_I32' => 8,
  'T_I64' => 10,
  'T_DOUBLE' => 4,
  'T_STRING' => 11,
  'T_STRUCT' => 12,
  'T_MAP' => 13,
  'T_SET' => 14,
  'T_LIST' => 15,
  'T_ENUM' => 101,
  'T_NOT_REFLECTED' => 102,
);

final class TTypeTag {
  const T_VOID = 1;
  const T_BOOL = 2;
  const T_BYTE = 3;
  const T_I16 = 6;
  const T_I32 = 8;
  const T_I64 = 10;
  const T_DOUBLE = 4;
  const T_STRING = 11;
  const T_STRUCT = 12;
  const T_MAP = 13;
  const T_SET = 14;
  const T_LIST = 15;
  const T_ENUM = 101;
  const T_NOT_REFLECTED = 102;
  static public $__names = array(
    1 => 'T_VOID',
    2 => 'T_BOOL',
    3 => 'T_BYTE',
    6 => 'T_I16',
    8 => 'T_I32',
    10 => 'T_I64',
    4 => 'T_DOUBLE',
    11 => 'T_STRING',
    12 => 'T_STRUCT',
    13 => 'T_MAP',
    14 => 'T_SET',
    15 => 'T_LIST',
    101 => 'T_ENUM',
    102 => 'T_NOT_REFLECTED',
  );
}

class SimpleType {
  static $_TSPEC;

  public $ttype = null;
  public $name = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'ttype',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'name',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['ttype'])) {
        $this->ttype = $vals['ttype'];
      }
      if (isset($vals['name'])) {
        $this->name = $vals['name'];
      }
    }
  }

  public function getName() {
    return 'SimpleType';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->ttype);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->name);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('SimpleType');
    if ($this->ttype !== null) {
      $xfer += $output->writeFieldBegin('ttype', TType::I32, 1);
      $xfer += $output->writeI32($this->ttype);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->name !== null) {
      $xfer += $output->writeFieldBegin('name', TType::STRING, 2);
      $xfer += $output->writeString($this->name);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class ContainerType {
  static $_TSPEC;

  public $ttype = null;
  public $subtype1 = null;
  public $subtype2 = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'ttype',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'subtype1',
          'type' => TType::STRUCT,
          'class' => 'SimpleType',
          ),
        3 => array(
          'var' => 'subtype2',
          'type' => TType::STRUCT,
          'class' => 'SimpleType',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['ttype'])) {
        $this->ttype = $vals['ttype'];
      }
      if (isset($vals['subtype1'])) {
        $this->subtype1 = $vals['subtype1'];
      }
      if (isset($vals['subtype2'])) {
        $this->subtype2 = $vals['subtype2'];
      }
    }
  }

  public function getName() {
    return 'ContainerType';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->ttype);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRUCT) {
            $this->subtype1 = new SimpleType();
            $xfer += $this->subtype1->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRUCT) {
            $this->subtype2 = new SimpleType();
            $xfer += $this->subtype2->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('ContainerType');
    if ($this->ttype !== null) {
      $xfer += $output->writeFieldBegin('ttype', TType::I32, 1);
      $xfer += $output->writeI32($this->ttype);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->subtype1 !== null) {
      if (!is_object($this->subtype1)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('subtype1', TType::STRUCT, 2);
      $xfer += $this->subtype1->write($output);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->subtype2 !== null) {
      if (!is_object($this->subtype2)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('subtype2', TType::STRUCT, 3);
      $xfer += $this->subtype2->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class ThriftType {
  static $_TSPEC;

  public $is_container = null;
  public $simple_type = null;
  public $container_type = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'is_container',
          'type' => TType::BOOL,
          ),
        2 => array(
          'var' => 'simple_type',
          'type' => TType::STRUCT,
          'class' => 'SimpleType',
          ),
        3 => array(
          'var' => 'container_type',
          'type' => TType::STRUCT,
          'class' => 'ContainerType',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['is_container'])) {
        $this->is_container = $vals['is_container'];
      }
      if (isset($vals['simple_type'])) {
        $this->simple_type = $vals['simple_type'];
      }
      if (isset($vals['container_type'])) {
        $this->container_type = $vals['container_type'];
      }
    }
  }

  public function getName() {
    return 'ThriftType';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->is_container);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRUCT) {
            $this->simple_type = new SimpleType();
            $xfer += $this->simple_type->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRUCT) {
            $this->container_type = new ContainerType();
            $xfer += $this->container_type->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('ThriftType');
    if ($this->is_container !== null) {
      $xfer += $output->writeFieldBegin('is_container', TType::BOOL, 1);
      $xfer += $output->writeBool($this->is_container);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->simple_type !== null) {
      if (!is_object($this->simple_type)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('simple_type', TType::STRUCT, 2);
      $xfer += $this->simple_type->write($output);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->container_type !== null) {
      if (!is_object($this->container_type)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('container_type', TType::STRUCT, 3);
      $xfer += $this->container_type->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class Argument {
  static $_TSPEC;

  public $key = null;
  public $name = null;
  public $type = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'key',
          'type' => TType::I16,
          ),
        2 => array(
          'var' => 'name',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'type',
          'type' => TType::STRUCT,
          'class' => 'ThriftType',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['key'])) {
        $this->key = $vals['key'];
      }
      if (isset($vals['name'])) {
        $this->name = $vals['name'];
      }
      if (isset($vals['type'])) {
        $this->type = $vals['type'];
      }
    }
  }

  public function getName() {
    return 'Argument';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->key);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->name);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRUCT) {
            $this->type = new ThriftType();
            $xfer += $this->type->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Argument');
    if ($this->key !== null) {
      $xfer += $output->writeFieldBegin('key', TType::I16, 1);
      $xfer += $output->writeI16($this->key);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->name !== null) {
      $xfer += $output->writeFieldBegin('name', TType::STRING, 2);
      $xfer += $output->writeString($this->name);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->type !== null) {
      if (!is_object($this->type)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('type', TType::STRUCT, 3);
      $xfer += $this->type->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class Method {
  static $_TSPEC;

  public $name = null;
  public $return_type = null;
  public $arguments = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'name',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'return_type',
          'type' => TType::STRUCT,
          'class' => 'ThriftType',
          ),
        3 => array(
          'var' => 'arguments',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => 'Argument',
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['name'])) {
        $this->name = $vals['name'];
      }
      if (isset($vals['return_type'])) {
        $this->return_type = $vals['return_type'];
      }
      if (isset($vals['arguments'])) {
        $this->arguments = $vals['arguments'];
      }
    }
  }

  public function getName() {
    return 'Method';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->name);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRUCT) {
            $this->return_type = new ThriftType();
            $xfer += $this->return_type->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::LST) {
            $this->arguments = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $elem5 = new Argument();
              $xfer += $elem5->read($input);
              $this->arguments []= $elem5;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Method');
    if ($this->name !== null) {
      $xfer += $output->writeFieldBegin('name', TType::STRING, 1);
      $xfer += $output->writeString($this->name);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->return_type !== null) {
      if (!is_object($this->return_type)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('return_type', TType::STRUCT, 2);
      $xfer += $this->return_type->write($output);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->arguments !== null) {
      if (!is_array($this->arguments)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('arguments', TType::LST, 3);
      {
        $output->writeListBegin(TType::STRUCT, count($this->arguments));
        {
          foreach ($this->arguments as $iter6)
          {
            $xfer += $iter6->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class Service {
  static $_TSPEC;

  public $name = null;
  public $methods = null;
  public $fully_reflected = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'name',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'methods',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => 'Method',
            ),
          ),
        3 => array(
          'var' => 'fully_reflected',
          'type' => TType::BOOL,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['name'])) {
        $this->name = $vals['name'];
      }
      if (isset($vals['methods'])) {
        $this->methods = $vals['methods'];
      }
      if (isset($vals['fully_reflected'])) {
        $this->fully_reflected = $vals['fully_reflected'];
      }
    }
  }

  public function getName() {
    return 'Service';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->name);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::LST) {
            $this->methods = array();
            $_size7 = 0;
            $_etype10 = 0;
            $xfer += $input->readListBegin($_etype10, $_size7);
            for ($_i11 = 0; $_i11 < $_size7; ++$_i11)
            {
              $elem12 = null;
              $elem12 = new Method();
              $xfer += $elem12->read($input);
              $this->methods []= $elem12;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->fully_reflected);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Service');
    if ($this->name !== null) {
      $xfer += $output->writeFieldBegin('name', TType::STRING, 1);
      $xfer += $output->writeString($this->name);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->methods !== null) {
      if (!is_array($this->methods)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('methods', TType::LST, 2);
      {
        $output->writeListBegin(TType::STRUCT, count($this->methods));
        {
          foreach ($this->methods as $iter13)
          {
            $xfer += $iter13->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->fully_reflected !== null) {
      $xfer += $output->writeFieldBegin('fully_reflected', TType::BOOL, 3);
      $xfer += $output->writeBool($this->fully_reflected);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

?>
