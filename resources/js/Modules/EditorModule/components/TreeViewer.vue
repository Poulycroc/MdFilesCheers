<template lang="pug">
.tree-viewer--editor--component-wrapper
    //- .tree-filter-holder.full.clearfix
        el-input.full(
            v-model="filterText"
            placeholder="Filter keyword"
        )

    .full.clearfix.pad_l_10.pad_r_10.pad_t_20(v-if="!allFilesTree.length")
        el-button.full(
            type="primary"
            @click="handleAddFile"
        )
            | Add File {{ isCrudFileModalVisible }}

    el-tree(
        v-else
        style="max-width: 600px"
        node-key="id"
        draggable
        default-expand-all
        :allow-drop="allowDrop"
        :allow-drag="allowDrag"
        :data="data"
        :filter-node-method="filterNode"
        @node-drag-start="handleDragStart"
        @node-drag-enter="handleDragEnter"
        @node-drag-leave="handleDragLeave"
        @node-drag-over="handleDragOver"
        @node-drag-end="handleDragEnd"
        @node-drop="handleDrop"
        @node-click="handleNodeClick"
    )

    crud-file-modal(v-model="isCrudFileModalVisible")
</template>

<script lang="ts" setup>
import { ref } from 'vue'

import type Node from 'element-plus/es/components/tree/src/model/node'
import type { DragEvents } from 'element-plus/es/components/tree/src/model/useDragNode'
import type {
  AllowDropType,
  NodeDropType,
} from 'element-plus/es/components/tree/src/tree.type'

import CrudFileModal from '@/Modules/EditorModule/components/modals/CrudFileEditorModal.vue'

interface Tree {
  [key: string]: any
}

const data = [
  {
    label: 'Level one 1',
    children: [
      {
        label: 'Level two 1-1',
        children: [
          {
            label: 'Level three 1-1-1',
          },
        ],
      },
    ],
  },
  {
    label: 'Level one 2',
    children: [
      {
        label: 'Level two 2-1',
        children: [
          {
            label: 'Level three 2-1-1',
          },
        ],
      },
      {
        label: 'Level two 2-2',
        children: [
          {
            label: 'Level three 2-2-1',
          },
        ],
      },
    ],
  },
  {
    label: 'Level one 3',
    children: [
      {
        label: 'Level two 3-1',
        children: [
          {
            label: 'Level three 3-1-1',
          },
        ],
      },
      {
        label: 'Level two 3-2',
        children: [
          {
            label: 'Level three 3-2-1',
          },
        ],
      },
    ],
  },
]

// props
defineProps({
    allFilesTree: {
        type: Array as PropType<object[]>,
        required: true,
        default: () => [],
    },
});

const filterText = ref<string>('')
const isCrudFileModalVisible = ref<boolean>(false);

// computed
const allowDrop = (draggingNode: Node, dropNode: Node, type: AllowDropType): boolean => {
    return dropNode.data.label === 'Level two 3-1'
        ? type !== 'inner'
        : true
}
const allowDrag = (draggingNode: Node): boolean => {
  return !draggingNode.data.label.includes('Level three 3-1-1')
}
const filterNode = (value: string, data: Tree): string => {
  if (!value) return true
  return data.label.includes(value)
}

// methods
const handleDragStart = (node: Node, ev: DragEvents) => {
  console.log('drag start', node)
}
const handleDragEnter = (
  draggingNode: Node,
  dropNode: Node,
  ev: DragEvents
) => {
  console.log('tree drag enter:', dropNode.label)
}
const handleDragLeave = (
  draggingNode: Node,
  dropNode: Node,
  ev: DragEvents
) => {
  console.log('tree drag leave:', dropNode.label)
}
const handleDragOver = (draggingNode: Node, dropNode: Node, ev: DragEvents) => {
  console.log('tree drag over:', dropNode.label)
}
const handleDragEnd = (
  draggingNode: Node,
  dropNode: Node,
  dropType: NodeDropType,
  ev: DragEvents
) => {
  console.log('tree drag end:', dropNode && dropNode.label, dropType)
}
const handleDrop = (
  draggingNode: Node,
  dropNode: Node,
  dropType: NodeDropType,
  ev: DragEvents
) => {
  console.log('tree drop:', dropNode.label, dropType)
}
const handleNodeClick = (node: Node) => {
    if (node.children) return
    console.log({ node })
}

const handleAddFile = () => {
    console.log({ isCrudFileModalVisible })
    isCrudFileModalVisible.value = true
}
</script>
