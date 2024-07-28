<?php
class TreeNode
{
    public $data;
    public $children = [];
    public $decision = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function add_child($key, $obj)
    {
        $this->children[$key] = $obj;
    }

    public function set_decision($decision)
    {
        $this->decision = $decision;
    }
}

function count_labels($labels)
{
    $label_count = [];
    foreach ($labels as $label) {
        if (array_key_exists($label, $label_count)) {
            $label_count[$label]++;
        } else {
            $label_count[$label] = 1;
        }
    }
    return $label_count;
}

function entropy($labels)
{
    $label_count = count_labels($labels);
    $entropy_value = 0.0;
    $total_count = count($labels);
    foreach ($label_count as $key => $count) {
        $probability = $count / $total_count;
        $entropy_value -= $probability * log($probability, 2);
    }
    return $entropy_value;
}

function gain($data, $labels, $attribute_index)
{
    $unique_values = array_unique(array_column($data, $attribute_index));
    $gain_value = entropy($labels);
    foreach ($unique_values as $value) {
        $subset_indices = array_keys(array_column($data, $attribute_index), $value);
        $subset_labels = array_intersect_key($labels, array_flip($subset_indices));
        $subset_entropy = entropy($subset_labels);
        $subset_weight = count($subset_indices) / count($data);
        $gain_value -= $subset_weight * $subset_entropy;
    }
    return $gain_value;
}

function build_tree($data, $labels, $attributes)
{

    if (count(array_unique($labels)) == 1) {
        $leaf = new TreeNode(null);
        $leaf->set_decision($labels[0]);
        return $leaf;
    }

    if (count($attributes) == 0) {
        $leaf = new TreeNode(null);
        $leaf->set_decision(array_key_first(count_labels($labels)));
        return $leaf;
    }

    $best_gain = -1;
    $best_attribute = null;

    foreach ($attributes as $attribute_index => $attribute) {
        $current_gain = gain($data, $labels, $attribute_index);
        if ($current_gain > $best_gain) {
            $best_gain = $current_gain;
            $best_attribute = $attribute_index;
        }
    }

    $root = new TreeNode($attributes[$best_attribute]);
    $unique_values = array_unique(array_column($data, $best_attribute));

    foreach ($unique_values as $value) {
        $subset_indices = array_keys(array_column($data, $best_attribute), $value);
        $subset_data = array_intersect_key($data, array_flip($subset_indices));
        $subset_labels = array_intersect_key($labels, array_flip($subset_indices));

        if (count($subset_data) == 0) {
            $leaf = new TreeNode(null);
            $leaf->set_decision(array_key_first(count_labels($labels)));
            $root->add_child($value, $leaf);
        } else {
            $subset_attributes = $attributes;
            unset($subset_attributes[$best_attribute]);
            $child = build_tree(array_values($subset_data), array_values($subset_labels), $subset_attributes);
            $root->add_child($value, $child);
        }
    }

    return $root;
}

function predict($tree, $instance)
{
    if ($tree->decision != null) {
        return $tree->decision;
    }

    $attribute_value = $instance[$tree->data];
    if (array_key_exists($attribute_value, $tree->children)) {
        return predict($tree->children[$attribute_value], $instance);
    } else {
        return null; 
    }
}
