<?php declare(strict_types=1);

namespace PhpNumStats\Commands;

use PhpParser\Node;
use PhpParser\Error;
use PhpParser\ParserFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

class AnalyseCommand extends Command
{
    protected static $defaultName = 'analyse';

    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $phpParser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $path = '.';
        $consoleOutStyle = new SymfonyStyle($input, $output);
        $finder = new Finder();
        $finder
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->ignoreUnreadableDirs()
            ->notPath(['vendor', 'Tests', 'tests'])
            ->name('*.php')
            ->in($path)
            ;
        $fileIterationCount = 1;
        $totalCountFiles = $finder->count();
        foreach ($finder as $splFileInfo) {
            try {
                $parserTree = $phpParser->parse(file_get_contents($splFileInfo->getRealPath()));
                $functionsCount = $this->getFunctionsCountFromNodeStmtArray($parserTree);
            } catch (Error $error) {
                $consoleOutStyle->error(sprintf('File %s parse error: %s', $splFileInfo->getRelativePathname(), $error->getMessage()));
                continue;
            }
            $lastElement = end($parserTree);
            $consoleOutStyle->writeln(sprintf(
                '%3d | functions and |%4d| lines found in file %5d/%d|%s',
                $functionsCount,
                $lastElement->getEndLine(),
                $fileIterationCount,
                $totalCountFiles,
                $splFileInfo->getRelativePathname()
            ));
            ++$fileIterationCount;
        }
    }

    /**
     * @param Node\Stmt[]|null $nodeStmts
     * @return int
     */
    public function getFunctionsCountFromNodeStmtArray(array $nodeStmts = null): int
    {
        $count = 0;
        foreach ($nodeStmts as $nodeStmt) {
            if ($nodeStmt instanceof Node\Stmt\Function_ || $nodeStmt instanceof Node\Stmt\ClassMethod) {
                ++$count;
            }

            if (!empty($nodeStmt->stmts)) {
                $count += $this->getFunctionsCountFromNodeStmtArray($nodeStmt->stmts);
            }
        }

        return $count;
    }

}
