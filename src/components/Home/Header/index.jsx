import React from 'react';
import './style.css';

function Header() {
  return (

    <header >
      <nav className='nav container'>
        <a href="" className='logo'><span>Blog</span>ster </a>
        <a className='btn-primary'>
          Login
        </a>
      </nav>
    </header>
  )
}

export default Header
