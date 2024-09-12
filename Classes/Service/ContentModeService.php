<?php

namespace Threeam\ThreeamFreeContentMode\Service;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class ContentModeService
{
    public function setFreeMode(ServerRequestInterface $request)
    {
        // Get the 'uid' parameter from the query string
        $queryParams = $request->getQueryParams();
        $uid = (int)($queryParams['uid'] ?? 0);

        // Check if 'uid' is valid
        if ($uid === 0) {
            return (new JsonResponse())->setPayload([
                'status' => 'error',
                'message' => 'Invalid page ID'
            ]);
        }

        // Get the QueryBuilder for the 'pages' table to retrieve the page data
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('pages');

        // Remove restrictions such as deleted, hidden, etc.
        $queryBuilder->getRestrictions()->removeAll();

        // Fetch the pid and sys_language_uid for the given uid
        $pageData = $queryBuilder
            ->select('l10n_parent', 'sys_language_uid')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid, \PDO::PARAM_INT))
            )
            ->execute()
            ->fetch();

        if (!$pageData) {
            return (new JsonResponse())->setPayload([
                'status' => 'error',
                'message' => 'Page not found'
            ]);
        }

        $l10nParent = (int)$pageData['l10n_parent'];
        $sysLanguageUid = (int)$pageData['sys_language_uid'];

        // Get the QueryBuilder for the 'tt_content' table
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');

        // Remove restrictions such as deleted, hidden, etc. from the tt_content query
        $queryBuilder->getRestrictions()->removeAll();

        // Update content elements where pid matches and sys_language_uid matches
        $affectedContentElements = $queryBuilder
            ->update('tt_content')
            ->where(
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($l10nParent, \PDO::PARAM_INT)),
                $queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter($sysLanguageUid, \PDO::PARAM_INT))
            )
            ->set('l18n_parent', 0)
            ->execute();

        // Return success response with the number of affected rows
        return (new JsonResponse())->setPayload([
            'status' => 'success',
            'message' => 'Free Mode set successfully',
            'affectedContentElements' => $affectedContentElements
        ]);
    }
}
