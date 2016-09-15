<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace Lengow\ImportExport\Export\Type;

use Lengow\FileFormat\FormatType;
use Lengow\ImportExport\Export\ExportHandler;
use Thelia\Model\Lang;
use Thelia\Model\Map\NewsletterTableMap;
use Thelia\Model\NewsletterQuery;

/**
 * Class MailingExport
 * @package Lengow\ImportExport\Export
 * @author Benjamin Perche <bperche@openstudio.fr>
 */
class MailingExport extends ExportHandler
{
    /**
     * @param  Lang                                            $lang
     * @return array|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function buildDataSet(Lang $lang)
    {
        $newsletter = NewsletterQuery::create()
            ->select([
                NewsletterTableMap::EMAIL,
                NewsletterTableMap::LASTNAME,
                NewsletterTableMap::FIRSTNAME,
            ])
            ->find()
            ->toArray()
        ;

        return $newsletter;
    }

    protected function getAliases()
    {
        $email = "email";
        $lastName = "last_name";
        $firstName = "first_name";

        return [
            NewsletterTableMap::EMAIL       => $email,
            NewsletterTableMap::LASTNAME    => $lastName,
            NewsletterTableMap::FIRSTNAME   => $firstName,
        ];
    }

    /**
     * @return string|array
     *
     * Define all the type of export/formatters that this can handle
     * return a string if it handle a single type ( specific exports ),
     * or an array if multiple.
     *
     * Thelia types are defined in \Lengow\FileFormat\FormatType
     *
     * example:
     * return array(
     *     FormatType::TABLE,
     *     FormatType::UNBOUNDED,
     * );
     */
    public function getHandledTypes()
    {
        return array(
            FormatType::TABLE,
            FormatType::UNBOUNDED,
        );
    }
}
