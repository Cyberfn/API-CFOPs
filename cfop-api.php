<?php
header("Content-Type: application/json");

function getCfops() {
    $html = file_get_contents("https://www.sefaz.pe.gov.br/Legislacao/Tributaria/Documents/Legislacao/Tabelas/CFOP.htm");
    $dom = new DOMDocument();
    @$dom->loadHTML($html);

    $data = [];
    $tables = $dom->getElementsByTagName("table");

    foreach ($tables as $table) {
        $rows = $table->getElementsByTagName("tr");
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName("td");
            if ($cols->length > 1) {
                $cfop = (int) str_replace('.', '', trim($cols->item(0)->textContent));
                $descricao = trim($cols->item(1)->textContent);

                if ($cfop > 0 && !empty($descricao)) {
                    $data[] = ["cfop" => $cfop, "descricao" => $descricao];
                }
            }
        }
    }

    if (!empty($data) && $data[0]['cfop'] === 0) {
        array_shift($data);
    }

    return $data;
}

if ($_SERVER['REQUEST_URI'] == '/cfop-api.php') {
    try {
        $cfops = getCfops();
        
        echo json_encode([
            "mensagem" => "CFOPs listados com sucesso!",
            "cfops" => $cfops
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } catch (Exception $e) {
    
        http_response_code(500);
        echo json_encode([
            "mensagem" => "Erro ao listar CFOPs.",
            "erro" => $e->getMessage()
        ]);
    }
} else {

    http_response_code(404);
    echo json_encode([
        "mensagem" => "Rota não encontrada."
    ]);
}
?>