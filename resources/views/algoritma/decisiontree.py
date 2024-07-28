# class TreeNode:
#     def __init__(self, data):
#         self.data = data
#         self.children = {}
#         self.decision = None

#     def add_child(self, key, obj):
#         self.children[key] = obj

#     def set_decision(self, decision):
#         self.decision = decision


# def count_labels(labels):
#     label_count = {}
#     for label in labels:
#         if label in label_count:
#             label_count[label] += 1
#         else:
#             label_count[label] = 1
#     return label_count


# def entropy(labels):
#     from math import log2
#     label_count = count_labels(labels)
#     entropy_value = 0.0
#     total_count = len(labels)
#     for key in label_count:
#         probability = label_count[key] / total_count
#         entropy_value -= probability * log2(probability)
#     return entropy_value


# def gain(data, labels, attribute_index):
#     unique_values = set([row[attribute_index] for row in data])
#     gain_value = entropy(labels)
#     for value in unique_values:
#         subset_indices = [i for i, row in enumerate(data) if row[attribute_index] == value]
#         subset_labels = [labels[i] for i in subset_indices]
#         subset_entropy = entropy(subset_labels)
#         subset_weight = len(subset_indices) / len(data)
#         gain_value -= subset_weight * subset_entropy
#     return gain_value


# def build_tree(data, labels, attributes):
#     if len(set(labels)) == 1:
#         leaf = TreeNode(None)
#         leaf.set_decision(labels[0])
#         return leaf

#     if len(attributes) == 0:
#         return None

#     best_gain = -1
#     best_attribute = None

#     for attribute_index in range(len(attributes)):
#         current_gain = gain(data, labels, attribute_index)
#         if current_gain > best_gain:
#             best_gain = current_gain
#             best_attribute = attribute_index

#     root = TreeNode(attributes[best_attribute])
#     unique_values = set([row[best_attribute] for row in data])

#     for value in unique_values:
#         subset_indices = [i for i, row in enumerate(data) if row[best_attribute] == value]
#         subset_data = [data[i] for i in subset_indices]
#         subset_labels = [labels[i] for i in subset_indices]
#         if len(subset_data) == 0:
#             leaf = TreeNode(None)
#             leaf.set_decision(max(set(labels), key=labels.count))
#             root.add_child(value, leaf)
#         else:
#             subset_attributes = attributes[:best_attribute] + attributes[best_attribute + 1:]
#             root.add_child(value, build_tree(subset_data, subset_labels, subset_attributes))

#     return root


# def print_tree(node, level=0):
#     if node.decision is not None:
#         print("  " * level + node.decision)
#         return
#     print("  " * level + node.data + "?")
#     for key in node.children:
#         print("  " * (level + 1) + key + ":", end="")
#         print_tree(node.children[key], level + 2)


# # Contoh penggunaan
# data = [
#     ['Muda', 'Rendah'],
#     ['Muda', 'Rendah'],
#     ['Muda', 'Tinggi'],
#     ['Dewasa', 'Rendah'],
#     ['Dewasa', 'Rendah'],
#     ['Dewasa', 'Tinggi'],
#     ['Tua', 'Rendah'],
#     ['Tua', 'Tinggi'],
#     ['Tua', 'Tinggi']
# ]

# labels = ['Tidak', 'Tidak', 'Ya', 'Tidak', 'Tidak', 'Ya', 'Tidak', 'Ya', 'Ya']

# attributes = ['Usia', 'Penghasilan']

# tree = build_tree(data, labels, attributes)
# print("Decision Tree:")
# print_tree(tree)


# def predict(tree, instance):
#     if tree.decision is not None:
#         return tree.decision
#     attribute_value = instance[tree.data]
#     if attribute_value in tree.children:
#         child_node = tree.children[attribute_value]
#         return predict(child_node, instance)
#     else:
#         return tree.decision


# instance1 = {'Usia': 'Muda', 'Penghasilan': 'Rendah'}
# instance2 = {'Usia': 'Tua', 'Penghasilan': 'Tinggi'}

# print("Prediksi untuk instance 1:", predict(tree, instance1))
# print("Prediksi untuk instance 2:", predict(tree, instance2))

import sys
import json

class TreeNode:
    def __init__(self, data):
        self.data = data
        self.children = {}
        self.decision = None

    def add_child(self, key, obj):
        self.children[key] = obj

    def set_decision(self, decision):
        self.decision = decision


def count_labels(labels):
    label_count = {}
    for label in labels:
        if label in label_count:
            label_count[label] += 1
        else:
            label_count[label] = 1
    return label_count


def entropy(labels):
    from math import log2
    label_count = count_labels(labels)
    entropy_value = 0.0
    total_count = len(labels)
    for key in label_count:
        probability = label_count[key] / total_count
        entropy_value -= probability * log2(probability)
    return entropy_value


def gain(data, labels, attribute_index):
    unique_values = set([row[attribute_index] for row in data])
    gain_value = entropy(labels)
    for value in unique_values:
        subset_indices = [i for i, row in enumerate(data) if row[attribute_index] == value]
        subset_labels = [labels[i] for i in subset_indices]
        subset_entropy = entropy(subset_labels)
        subset_weight = len(subset_indices) / len(data)
        gain_value -= subset_weight * subset_entropy
    return gain_value


def build_tree(data, labels, attributes):
    if len(set(labels)) == 1:
        leaf = TreeNode(None)
        leaf.set_decision(labels[0])
        return leaf

    if len(attributes) == 0:
        return None

    best_gain = -1
    best_attribute = None

    for attribute_index in range(len(attributes)):
        current_gain = gain(data, labels, attribute_index)
        if current_gain > best_gain:
            best_gain = current_gain
            best_attribute = attribute_index

    root = TreeNode(attributes[best_attribute])
    unique_values = set([row[best_attribute] for row in data])

    for value in unique_values:
        subset_indices = [i for i, row in enumerate(data) if row[best_attribute] == value]
        subset_data = [data[i] for i in subset_indices]
        subset_labels = [labels[i] for i in subset_indices]
        if len(subset_data) == 0:
            leaf = TreeNode(None)
            leaf.set_decision(max(set(labels), key=labels.count))
            root.add_child(value, leaf)
        else:
            subset_attributes = attributes[:best_attribute] + attributes[best_attribute + 1:]
            root.add_child(value, build_tree(subset_data, subset_labels, subset_attributes))

    return root


def print_tree(node, level=0):
    if node.decision is not None:
        print("  " * level + node.decision)
        return
    print("  " * level + node.data + "?")
    for key in node.children:
        print("  " * (level + 1) + key + ":", end="")
        print_tree(node.children[key], level + 2)


def predict(tree, instance):
    if tree.decision is not None:
        return tree.decision
    attribute_value = instance[tree.data]
    if attribute_value in tree.children:
        child_node = tree.children[attribute_value]
        return predict(child_node, instance)
    else:
        # Jika nilai atribut tidak ditemukan dalam anak-anak node, kembalikan keputusan mayoritas dari node saat ini
        return tree.decision


# if __name__ == "__main__":
#     # Ambil input data dari argumen
#     data = json.loads(sys.argv[1])
#     labels = json.loads(sys.argv[2])
#     instance = json.loads(sys.argv[3])

#     attributes = ['kesepakatan', 'lokasi', 'pelayanan']
#     tree = build_tree(data, labels, attributes)
    
#     prediction = predict(tree, instance)
#     print(prediction)

if __name__ == "__main__":
    if len(sys.argv) < 4:
        print("Usage: python decisiontree.py <data> <labels> <validatedata>")
        sys.exit(1)

    try:
        data = json.loads(sys.argv[1])
        labels = json.loads(sys.argv[2])
        validatedata = json.loads(sys.argv[3])

        print("Data:", data)
        print("Labels:", labels)
        print("Validated Data:", validatedata)
        
        # Lakukan logika decision tree atau proses prediksi lainnya di sini

    except Exception as e:
        print("Error:", str(e))