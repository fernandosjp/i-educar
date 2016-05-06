<?php
/**
 * i-Educar - Sistema de gest�o escolar
 *
 * Copyright (C) 2006  Prefeitura Municipal de Itaja�
 *                     <ctima@itajai.sc.gov.br>
 *
 * Este programa � software livre; voc� pode redistribu�-lo e/ou modific�-lo
 * sob os termos da Licen�a P�blica Geral GNU conforme publicada pela Free
 * Software Foundation; tanto a vers�o 2 da Licen�a, como (a seu crit�rio)
 * qualquer vers�o posterior.
 *
 * Este programa � distribu��do na expectativa de que seja �til, por�m, SEM
 * NENHUMA GARANTIA; nem mesmo a garantia impl��cita de COMERCIABILIDADE OU
 * ADEQUA��O A UMA FINALIDADE ESPEC�FICA. Consulte a Licen�a P�blica Geral
 * do GNU para mais detalhes.
 *
 * Voc� deve ter recebido uma c�pia da Licen�a P�blica Geral do GNU junto
 * com este programa; se n�o, escreva para a Free Software Foundation, Inc., no
 * endere�o 59 Temple Street, Suite 330, Boston, MA 02111-1307 USA.
 *
 * @author    Lucas Schmoeller da Silva <lucas@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   iEd_Pmieducar
 * @since     ?
 * @version   $Id$
 */

require_once 'include/pmieducar/geral.inc.php';

/**
 * clsPmieducarCandidatoReservaVaga class.
 *
 * @author    Lucas Schmoeller da Silva <lucas@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   iEd_Pmieducar
 * @since     ?
 * @version   @@package_version@@
 */
class clsPmieducarCandidatoReservaVaga
{

  var $cod_candidato_reserva_vaga;
  var $ano_letivo;
  var $data_solicitacao;
  var $ref_cod_aluno;
  var $ref_cod_serie;
  var $ref_cod_turno;
  var $ref_cod_pessoa_cad;
  var $data_cad;
  var $data_update;
  var $ref_cod_matricula;
  var $situacao;
  var $data_situacao;
  var $quantidade_membros;

  /**
   * Armazena o total de resultados obtidos na �ltima chamada ao m�todo lista().
   * @var int
   */
  var $_total;

  /**
   * Nome do schema.
   * @var string
   */
  var $_schema;

  /**
   * Nome da tabela.
   * @var string
   */
  var $_tabela;

  /**
   * Lista separada por v�rgula, com os campos que devem ser selecionados na
   * pr�xima chamado ao m�todo lista().
   * @var string
   */
  var $_campos_lista;

  /**
   * Lista com todos os campos da tabela separados por v�rgula, padr�o para
   * sele��o no m�todo lista.
   * @var string
   */
  var $_todos_campos;

  /**
   * Valor que define a quantidade de registros a ser retornada pelo m�todo lista().
   * @var int
   */
  var $_limite_quantidade;

  /**
   * Define o valor de offset no retorno dos registros no m�todo lista().
   * @var int
   */
  var $_limite_offset;

  /**
   * Define o campo para ser usado como padr�o de ordena��o no m�todo lista().
   * @var string
   */
  var $_campo_order_by;

  /**
   * Construtor.
   */
  function __construct($cod_candidato_reserva_vaga = NULL, $ano_letivo = NULL, $data_solicitacao = NULL,
    $ref_cod_aluno = NULL, $ref_cod_serie = NULL, $ref_cod_turno = NULL,
    $ref_cod_pessoa_cad = NULL, $ref_cod_escola = NULL, $quantidade_membros = NULL)
  {
    $db = new clsBanco();
    $this->_schema = 'pmieducar.';
    $this->_tabela = $this->_schema . 'candidato_reserva_vaga crv ';

    $this->_campos_lista = $this->_todos_campos = ' crv.cod_candidato_reserva_vaga, crv.ano_letivo, crv.data_solicitacao,
      crv.ref_cod_aluno, crv.ref_cod_serie, crv.ref_cod_turno, crv.ref_cod_pessoa_cad, crv.data_cad, crv.data_update, crv.data_situacao, crv.situacao, crv.ref_cod_matricula, crv.ref_cod_escola, crv.quantidade_membros  ';

    if (is_numeric($cod_candidato_reserva_vaga)) {
      $this->cod_candidato_reserva_vaga = $cod_candidato_reserva_vaga;
    }

    if (is_numeric($ano_letivo)) {
      $this->ano_letivo = $ano_letivo;
    }

    if (is_string($data_solicitacao)) {
      $this->data_solicitacao = $data_solicitacao;
    }

    if (is_numeric($ref_cod_aluno)) {
      $this->ref_cod_aluno = $ref_cod_aluno;
    }

    if (is_numeric($ref_cod_serie)) {
      $this->ref_cod_serie = $ref_cod_serie;
    }

    if (is_numeric($ref_cod_turno)) {
      $this->ref_cod_turno = $ref_cod_turno;
    }

    if (is_numeric($ref_cod_pessoa_cad)) {
      $this->ref_cod_pessoa_cad = $ref_cod_pessoa_cad;
    }

    if (is_numeric($ref_cod_escola)) {
      $this->ref_cod_escola = $ref_cod_escola;
    }

    if (is_numeric($quantidade_membros)) {
      $this->quantidade_membros = $quantidade_membros;
    }
  }

  /**
   * Cria um novo registro.
   * @return bool
   */
  function cadastra()
  {
    if (is_numeric($this->ano_letivo) && is_string($this->data_solicitacao) && is_numeric($this->ref_cod_aluno)
      && is_numeric($this->ref_cod_serie) && is_numeric($this->ref_cod_pessoa_cad)) {
      $db = new clsBanco();

      $campos  = '';
      $valores = '';
      $gruda   = '';

      if (is_numeric($this->cod_candidato_reserva_vaga)) {
        $campos  .= "{$gruda}cod_candidato_reserva_vaga";
        $valores .= "{$gruda}'{$this->cod_candidato_reserva_vaga}'";
        $gruda = ', ';
      }

      if (is_numeric($this->ano_letivo)) {
        $campos  .= "{$gruda}ano_letivo";
        $valores .= "{$gruda}'{$this->ano_letivo}'";
        $gruda = ', ';
      }

      if (is_string($this->data_solicitacao)) {
        $campos  .= "{$gruda}data_solicitacao";
        $valores .= "{$gruda}'{$this->data_solicitacao}'";
        $gruda = ', ';
      }

      if (is_numeric($this->ref_cod_aluno)) {
        $campos  .= "{$gruda}ref_cod_aluno";
        $valores .= "{$gruda}'{$this->ref_cod_aluno}'";
        $gruda = ', ';
      }

      if (is_numeric($this->ref_cod_serie)) {
        $campos  .= "{$gruda}ref_cod_serie";
        $valores .= "{$gruda}'{$this->ref_cod_serie}'";
        $gruda = ', ';
      }

      if (is_numeric($this->ref_cod_turno)) {
        $campos  .= "{$gruda}ref_cod_turno";
        $valores .= "{$gruda}'{$this->ref_cod_turno}'";
        $gruda = ', ';
      }

      if (is_numeric($this->quantidade_membros)) {
        $campos  .= "{$gruda}quantidade_membros";
        $valores .= "{$gruda}'{$this->quantidade_membros}'";
        $gruda = ', ';
      }

      if (is_numeric($this->ref_cod_pessoa_cad)) {
        $campos  .= "{$gruda}ref_cod_pessoa_cad";
        $valores .= "{$gruda}'{$this->ref_cod_pessoa_cad}'";
        $gruda = ', ';
      }

      $campos  .= "{$gruda}data_cad";
      $valores .= "{$gruda}NOW()";
      $gruda = ', ';

      $campos  .= "{$gruda}data_update";
      $valores .= "{$gruda}NOW()";
      $gruda = ', ';

      $campos  .= "{$gruda}ref_cod_escola";
      $valores .= "{$gruda}'{$this->ref_cod_escola}'";
      $gruda = ', ';

      $db->Consulta("INSERT INTO pmieducar.candidato_reserva_vaga ($campos) VALUES ($valores)");
      return $db->InsertId("pmieducar.candidato_reserva_vaga_seq");
    }

    return FALSE;
  }

  /**
   * Edita os dados de um registro.
   * @return bool
   */
  function edita()
  {
    if (is_numeric($this->cod_candidato_reserva_vaga)) {
      $db  = new clsBanco();
      $set = '';

      if (is_numeric($this->ano_letivo)) {
        $set .= "{$gruda}ano_letivo = '{$this->ano_letivo}'";
        $gruda = ', ';
      }

      if (is_string($this->data_solicitacao)) {
        $set .= "{$gruda}data_solicitacao = '{$this->data_solicitacao}'";
        $gruda = ', ';
      }

      if (is_numeric($this->ref_cod_aluno)) {
        $set .= "{$gruda}ref_cod_aluno = '{$this->ref_cod_aluno}'";
        $gruda = ', ';
      }

      if (is_numeric($this->ref_cod_serie)) {
        $set .= "{$gruda}ref_cod_serie = '{$this->ref_cod_serie}'";
        $gruda = ', ';
      }

      if (is_numeric($this->ref_cod_turno)) {
        $set .= "{$gruda}ref_cod_turno = '{$this->ref_cod_turno}'";
        $gruda = ', ';
      }

      $campos  .= "{$gruda}data_update = NOW() ";
      $gruda = ', ';

      if (is_numeric($this->ref_cod_escola)) {
        $set .= "{$gruda}ref_cod_escola = '{$this->ref_cod_escola}'";
        $gruda = ', ';
      }

      if (is_numeric($this->quantidade_membros)) {
        $set .= "{$gruda}quantidade_membros = '{$this->quantidade_membros}'";
        $gruda = ', ';
      }

      if ($set) {
        $db->Consulta("UPDATE {$this->_tabela} SET $set WHERE cod_candidato_reserva_vaga = '{$this->cod_candidato_reserva_vaga}'" );
        return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * Retorna uma lista de registros filtrados de acordo com os par�metros.
   * @return array
   */
  function lista($ano_letivo = NULL, $nome = NULL, $nome_responsavel = NULL, $ref_cod_escola = NULL, $ref_cod_serie = NULL, $ref_cod_curso = NULL, $ref_cod_turno = NULL, $ref_cod_aluno = NULL, $situacaoEmEspera = FALSE)
  {
    $filtros = '';
    $this->resetCamposLista();

    $sql = "SELECT {$this->_campos_lista}, resp_pes.nome as nome_responsavel, pes.nome as nome
              FROM {$this->_tabela}
              INNER JOIN pmieducar.aluno a ON a.cod_aluno = crv.ref_cod_aluno
              INNER JOIN cadastro.pessoa pes ON pes.idpes = a.ref_idpes
              INNER JOIN cadastro.fisica fis ON fis.idpes = pes.idpes
              INNER JOIN cadastro.pessoa resp_pes ON fis.idpes_responsavel = resp_pes.idpes
              INNER JOIN pmieducar.serie AS ser ON ser.cod_serie = crv.ref_cod_serie ";
    $whereAnd = ' WHERE ';

    $filtros = '';

    if(is_numeric($ano_letivo)){
      $filtros .= " {$whereAnd} ano_letivo = {$ano_letivo} ";
      $whereAnd = ' AND ';
    }

    if(is_string($nome)){
      $filtros .= " {$whereAnd} TO_ASCII(LOWER(pes.nome)) LIKE TO_ASCII(LOWER('%{$nome}%')) ";
      $whereAnd = ' AND ';
    }

    if(is_string($nome_responsavel)){
      $filtros .= " {$whereAnd} TO_ASCII(LOWER(resp_pes.nome)) LIKE TO_ASCII(LOWER('%{$nome_responsavel}%')) ";
      $whereAnd = ' AND ';
    }

    if(is_numeric($ref_cod_escola)){
      $filtros .= " {$whereAnd} ref_cod_escola = {$ref_cod_escola} ";
      $whereAnd = ' AND ';
    }

    if(is_numeric($ref_cod_serie)){
      $filtros .= " {$whereAnd} crv.ref_cod_serie = {$ref_cod_serie} ";
      $whereAnd = ' AND ';
    }

    if(is_numeric($ref_cod_curso)){
      $filtros .= " {$whereAnd} ser.ref_cod_curso = {$ref_cod_curso} ";
      $whereAnd = ' AND ';
    }

    if($ref_cod_turno != 0){
      $filtros .= " {$whereAnd} crv.ref_cod_turno = {$ref_cod_turno} ";
      $whereAnd = ' AND ';
    }

    if(is_numeric($ref_cod_aluno)){
      $filtros .= " {$whereAnd} ref_cod_aluno = {$ref_cod_aluno} ";
      $whereAnd = ' AND ';
    }

    if($situacaoEmEspera){
      $filtros .= " {$whereAnd} crv.situacao IS NULL";
      $whereAnd = ' AND ';
    }

    $db = new clsBanco();
    $countCampos = count(explode(',', $this->_campos_lista));
    $resultado = array();

    $sql .= $filtros . $this->getOrderby() . $this->getLimite();
    $this->_total = $db->CampoUnico("SELECT COUNT(0) FROM {$this->_tabela}
              INNER JOIN pmieducar.aluno a ON a.cod_aluno = crv.ref_cod_aluno
              INNER JOIN cadastro.pessoa pes ON pes.idpes = a.ref_idpes
              INNER JOIN cadastro.fisica fis ON fis.idpes = pes.idpes
              INNER JOIN cadastro.pessoa resp_pes ON fis.idpes_responsavel = resp_pes.idpes
              INNER JOIN pmieducar.serie AS ser ON ser.cod_serie = crv.ref_cod_serie {$filtros}");

    $db->Consulta($sql);

    if ($countCampos > 1) {
      while ($db->ProximoRegistro()) {
        $tupla = $db->Tupla();
        $tupla['_total'] = $this->_total;
        $resultado[] = $tupla;
      }
    }
    else {
      while ($db->ProximoRegistro()) {
        $tupla = $db->Tupla();
        $resultado[] = $tupla[$this->_campos_lista];
      }
    }

    if (count($resultado)) {
      return $resultado;
    }

    return FALSE;
  }

  /**
   * Retorna um array com os dados de um registro
   * @return array
   */
  function detalhe()
  {
    if (is_numeric($this->cod_candidato_reserva_vaga)) {
      $db = new clsBanco();
      $db->Consulta("SELECT {$this->_todos_campos}, resp_pes.nome as nome_responsavel, pes.nome as nome, crv.motivo as motivo, (SELECT nm_serie FROM pmieducar.serie WHERE cod_serie = ref_cod_serie) as serie FROM {$this->_tabela}
                      INNER JOIN pmieducar.aluno a ON a.cod_aluno = crv.ref_cod_aluno
                      INNER JOIN cadastro.pessoa pes ON pes.idpes = a.ref_idpes
                      INNER JOIN cadastro.fisica fis ON fis.idpes = pes.idpes
                      INNER JOIN cadastro.pessoa resp_pes ON fis.idpes_responsavel = resp_pes.idpes
                      WHERE cod_candidato_reserva_vaga = '{$this->cod_candidato_reserva_vaga}'");
      $db->ProximoRegistro();
      return $db->Tupla();
    }
    return FALSE;
  }

  function atualizaDesistente($ano_letivo = NULL, $ref_cod_serie = NULL, $ref_cod_aluno = NULL, $ref_cod_escola = NULL)
  {
    $filtros = '';
    $this->resetCamposLista();

    $sql = "UPDATE {$this->_tabela}
               SET situacao = 'D'";

    $whereAnd = ' WHERE ';

    $filtros = '';

    if(is_numeric($ano_letivo)){
      $filtros .= " {$whereAnd} ano_letivo = {$ano_letivo} ";
      $whereAnd = ' AND ';
    }

    if(is_numeric($ref_cod_serie)){
      $filtros .= " {$whereAnd} ref_cod_serie = {$ref_cod_serie} ";
      $whereAnd = ' AND ';
    }

    if(is_numeric($ref_cod_aluno)){
      $filtros .= " {$whereAnd} ref_cod_aluno = {$ref_cod_aluno} ";
      $whereAnd = ' AND ';
    }

    if(is_numeric($ref_cod_escola)){
      $filtros .= " {$whereAnd} ref_cod_escola <> {$ref_cod_escola} ";
      $whereAnd = ' AND ';
    }

    $db = new clsBanco();
    $countCampos = count(explode(',', $this->_campos_lista));
    $resultado = array();

    $sql .= $filtros . $this->getOrderby() . $this->getLimite();

    $db->Consulta($sql);

    return TRUE;
  }
  /**
   * Retorna um array com os dados de um registro.
   * @return array
   */
  function existe()
  {
    if (is_numeric($this->cod_candidato_reserva_vaga)) {
      $db = new clsBanco();
      $db->Consulta("SELECT 1 FROM {$this->_tabela} WHERE cod_candidato_reserva_vaga = '{$this->cod_candidato_reserva_vaga}'");
      $db->ProximoRegistro();
      return $db->Tupla();
    }

    return FALSE;
  }


  /**
   * Exclui um registro.
   * @return bool
   */
  function excluir()
  {
    if (is_numeric($this->cod_candidato_reserva_vaga)) {
      $db = new clsBanco();
      $db->Consulta("DELETE FROM {$this->_tabela} WHERE cod_candidato_reserva_vaga = '{$this->cod_candidato_reserva_vaga}'");
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Define quais campos da tabela ser�o selecionados no m�todo Lista().
   */
  function setCamposLista($str_campos)
  {
    $this->_campos_lista = $str_campos;
  }

  /**
   * Define que o m�todo Lista() deverpa retornar todos os campos da tabela.
   */
  function resetCamposLista()
  {
    $this->_campos_lista = $this->_todos_campos;
  }

  /**
   * Define limites de retorno para o m�todo Lista().
   */
  function setLimite($intLimiteQtd, $intLimiteOffset = NULL)
  {
    $this->_limite_quantidade = $intLimiteQtd;
    $this->_limite_offset = $intLimiteOffset;
  }

  /**
   * Retorna a string com o trecho da query respons�vel pelo limite de
   * registros retornados/afetados.
   *
   * @return string
   */
  function getLimite()
  {
    if (is_numeric($this->_limite_quantidade)) {
      $retorno = " LIMIT {$this->_limite_quantidade}";
      if (is_numeric($this->_limite_offset)) {
        $retorno .= " OFFSET {$this->_limite_offset} ";
      }
      return $retorno;
    }
    return '';
  }

  /**
   * Define o campo para ser utilizado como ordena��o no m�todo Lista().
   */
  function setOrderby($strNomeCampo)
  {
    if (is_string($strNomeCampo) && $strNomeCampo ) {
      $this->_campo_order_by = $strNomeCampo;
    }
  }

  /**
   * Retorna a string com o trecho da query respons�vel pela Ordena��o dos
   * registros.
   *
   * @return string
   */
  function getOrderby()
  {
    if (is_string($this->_campo_order_by)) {
      return " ORDER BY {$this->_campo_order_by} ";
    }
    return '';
  }

  function vinculaMatricula($ref_cod_matricula)
  {
    if (is_numeric($this->cod_candidato_reserva_vaga) && is_numeric($ref_cod_matricula)) {
      $db = new clsBanco();
      $db->Consulta("UPDATE pmieducar.candidato_reserva_vaga SET ref_cod_matricula = '{$ref_cod_matricula}', situacao = 'A', data_situacao = NOW()
                      WHERE cod_candidato_reserva_vaga = '{$this->cod_candidato_reserva_vaga}'");
      $db->ProximoRegistro();
      return $db->Tupla();
    }
    return FALSE;
  }

  function indefereOutrasReservas($cod_aluno)
  {
    if (is_numeric($this->cod_candidato_reserva_vaga) && is_numeric($cod_aluno)) {
      $db = new clsBanco();
      $db->Consulta("UPDATE pmieducar.candidato_reserva_vaga SET situacao = 'N', data_situacao = NOW()
                      WHERE cod_candidato_reserva_vaga <> '{$this->cod_candidato_reserva_vaga}'
                      AND ref_cod_aluno = {$cod_aluno} ");
      $db->ProximoRegistro();
      return $db->Tupla();
    }
    return FALSE;
  }

  function indefereSolicitacao($motivo = null)
  {
    $motivo = $motivo == null ? "null" : "'". $motivo ."'";

    if (is_numeric($this->cod_candidato_reserva_vaga)) {
      $db = new clsBanco();
      $db->Consulta("UPDATE pmieducar.candidato_reserva_vaga SET situacao = 'N', motivo = $motivo, data_situacao = NOW()
                      WHERE cod_candidato_reserva_vaga = '{$this->cod_candidato_reserva_vaga}'");
      $db->ProximoRegistro();
      return $db->Tupla();
    }
    return FALSE;
  }

}