<?php
require_once __DIR__ . '/../models/StatsModel.php';
require_once __DIR__ . '/../core/Controller.php';

class StatsController extends Controller {
    private $statsModel;

    public function __construct() {
        $database = new Database();
        $this->statsModel = new StatsModel($database);
    }

    public function consulterStatistiques() {
        try {
            $products = $this->statsModel->getTopProducts();
            $months = $this->statsModel->getMonthlyCommands();

            $product_names = [];
            $sales_data = []; 
            $background_colors = [];
            
            foreach ($products as $product) {
                $product_names[] = $product['libelle'];
                $sales_data[] = $product['total_commandes']; 
                $r = rand(0, 255);
                $g = rand(0, 255);
                $b = rand(0, 255);
                $background_colors[] = "rgba($r, $g, $b, 0.7)";
            }

            $month_labels = [];
            $command_counts = [];
            foreach ($months as $month) {
                $month_labels[] = date('M Y', strtotime($month['month']));
                $command_counts[] = $month['command_count'];
            }

            $this->render('stats/dashboard', [
                'product_names' => $product_names,
                'sales_data' => $sales_data,
                'background_colors' => $background_colors,
                'month_labels' => $month_labels,
                'command_counts' => $command_counts
            ]);

        } catch (Exception $e) {
            $this->render('stats/dashboard', ['message' => $e->getMessage()]);
        }
    }


}