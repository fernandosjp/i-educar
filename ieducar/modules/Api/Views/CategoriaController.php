<?php

#error_reporting(E_ALL);
#ini_set("display_errors", 1);

/**
 * i-Educar - Sistema de gestão escolar
 *
 * Copyright (C) 2006  Prefeitura Municipal de Itajaí
 *     <ctima@itajai.sc.gov.br>
 *
 * Este programa é software livre; você pode redistribuí-lo e/ou modificá-lo
 * sob os termos da Licença Pública Geral GNU conforme publicada pela Free
 * Software Foundation; tanto a versão 2 da Licença, como (a seu critério)
 * qualquer versão posterior.
 *
 * Este programa é distribuí­do na expectativa de que seja útil, porém, SEM
 * NENHUMA GARANTIA; nem mesmo a garantia implí­cita de COMERCIABILIDADE OU
 * ADEQUAÇÃO A UMA FINALIDADE ESPECÍFICA. Consulte a Licença Pública Geral
 * do GNU para mais detalhes.
 *
 * Você deve ter recebido uma cópia da Licença Pública Geral do GNU junto
 * com este programa; se não, escreva para a Free Software Foundation, Inc., no
 * endereço 59 Temple Street, Suite 330, Boston, MA 02111-1307 USA.
 *
 * @author    Lucas Schmoeller da Silva <lucas@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   Api
 * @subpackage  Modules
 * @since   Arquivo disponível desde a versão ?
 * @version   $Id$
 */

require_once 'lib/Portabilis/Controller/ApiCoreController.php';
require_once 'lib/Portabilis/Array/Utils.php';
require_once 'lib/Portabilis/String/Utils.php';
require_once 'intranet/include/pmieducar/clsPmieducarCategoriaAcervo.inc.php';

/**
 * Class CategoriaController
 * @deprecated Essa versão da API pública será descontinuada
 */
class CategoriaController extends ApiCoreController
{
  // search options

  /*protected function searchOptions() {
    return array('namespace' => 'pmieducar', 'labelAttr' => 'descricao', 'idAttr' => 'id');
  }

  protected function formatResourceValue($resource) {
    return $this->toUtf8($resource['name'], array('transform' => true));
  }*/

  protected function getCategorias() {
    
    $obj = new clsPmieducarCategoriaAcervo();
    $arrayCategorias;
    
    foreach ($obj->listaCategoriasPorObra($this->getRequest()->id) as $reg) {
      $arrayCategorias[] = $reg['categoria_id'];
    }    
    
    return array('categorias' => $arrayCategorias);
  }

  public function Gerar() {
    if ($this->isRequestFor('get', 'categoria-search'))
      $this->appendResponse($this->search());
    elseif ($this->isRequestFor('get', 'categorias'))
      $this->appendResponse($this->getCategorias());
    else
      $this->notImplementedOperationError();
  }
}