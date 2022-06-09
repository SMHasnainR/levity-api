import React from 'react'
import './style.css'
function SearchBar ({value, handleSearchKey, clearSearch, formSubmit}) {
  return (
    <div className='searchBar-wrap'>
        <form onSubmit={formSubmit} >
            <input 
            type="text" 
            onChange={handleSearchKey} 
            placeholder='search blog'
            value={value}
            />

            { value && <span onClick={clearSearch}>x</span>}
            <button>Go</button>
        </form>
    </div>
  )
}

export default SearchBar 