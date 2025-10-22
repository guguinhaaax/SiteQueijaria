<?php
$host = 'localhost';
$db = 'queijaria';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Configurações para o Retry
$maxTentativas = 3; // Número máximo de tentativas de conexão
$intervaloTentativa = 1; // Intervalo em segundos entre as tentativas

$tentativa = 0;
$pdo = null; // Inicializa a variável $pdo como null

while ($tentativa < $maxTentativas && $pdo === null) {
    $tentativa++;
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        // Se a conexão for bem-sucedida, o loop termina
    } catch (\PDOException $e) {
        // Se falhou, verifica se ainda há tentativas restantes
        if ($tentativa < $maxTentativas) {
            // Espera antes da próxima tentativa
            sleep($intervaloTentativa); 
        } else {
            // Se foi a última tentativa e falhou, lança a exceção
            // Pode adicionar um log aqui se desejar, antes de lançar a exceção
            error_log("Falha ao conectar ao banco de dados após $maxTentativas tentativas: " . $e->getMessage());
            // Lança a exceção para que a aplicação pare ou trate o erro mais acima
            http_response_code(503); // Service Unavailable
            die(json_encode(['message' => 'Erro crítico: Não foi possível conectar ao banco de dados. Tente novamente mais tarde.']));
            // Ou, se preferir lançar a exceção original:
            // throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}

// Neste ponto, $pdo ou contém a conexão bem-sucedida ou a execução foi terminada pelo die()/throw.
?>